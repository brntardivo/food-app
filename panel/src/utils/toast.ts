interface IFirePayload {
  text: string;
  title?: string;
  timer?: number;
  position?: string;
  icon?: string;
}

interface IConfiguratorParam {
  enableTitle?: boolean;
  timer?: number;
  position?: string;
  enableClose?: boolean;
}

interface IToast {
  configurator: IConfiguratorParam;
  container: HTMLElement | null;
  fire: (props: IFirePayload | string) => Promise<void>;
}

const generateUniqueID = () => {
  return `toast-${Date.now()}`;
};

const removeToast = async (uniqueId: string, container: HTMLElement) => {
  const toast = document.getElementById(uniqueId);

  if (toast && container) {
    toast.classList.remove("show");

    setTimeout(() => {
      container.removeChild(toast);
    }, 200);
  }
};

export default class Toast implements IToast {
  configurator;
  container;

  constructor(props: IConfiguratorParam | void) {
    this.configurator = {
      enableTitle: false,
      timer: NaN,
      position: "top-right",
      enableClose: true,
      icon: "",
      ...props,
    };
    const containerId = "toast-container";
    this.container = document.getElementById(containerId);

    if (!this.container) {
      const e = document.createElement("div");
      e.id = containerId;

      e.classList.add(`toast-position-${this.configurator.position}`);

      document.body.prepend(e);

      this.container = document.getElementById(containerId);
    }
  }

  async fire(payload: IFirePayload | string) {
    if (typeof payload === "string") {
      payload = {
        text: payload,
      };
    }

    if (!this.container) {
      throw new Error("[toast][error] container not found");
    }

    if (payload.position) {
      const position = payload.position.toString().toLowerCase();

      const allowedPositions = [
        "top-left",
        "top-center",
        "top-right",
        "bottom-left",
        "bottom-center",
        "bottom-right",
      ];

      if (allowedPositions.indexOf(position) > -1) {
        this.container.classList.remove(
          `toast-position-${this.configurator.position}`
        );
        this.container.classList.add(`toast-position-${position}`);
      } else {
        throw new Error("[toast][error] invalid position");
      }
    }

    const uniqueId = generateUniqueID();

    const toast = document.createElement("div");

    toast.id = uniqueId;
    toast.setAttribute("role", "alert");
    toast.classList.add("toast");
    toast.classList.add("fade");

    if (payload.icon) {
      const icon = document.createElement("img");
      icon.classList.add("toast-icon-container");
      icon.src = (
        await import(`@assets/images/${payload.icon}_icon.svg`)
      ).default;
      toast.append(icon);

      toast.classList.add("toast-icon");
    }

    if (this.configurator.enableTitle || payload.title) {
      const title = document.createElement("div");
      title.classList.add("toast-header");

      const span = document.createElement("span");
      span.innerHTML = payload.title ?? "";

      title.append(span);

      toast.append(title);
    }

    const text = document.createElement("div");
    text.classList.add("toast-body");
    text.innerHTML = payload.text ?? "";

    toast.append(text);

    if (!this.configurator.enableTitle && this.configurator.enableClose) {
      const btn = document.createElement("button");
      btn.classList.add("btn-close");
      btn.setAttribute("aria-label", "Close");
      btn.dataset.id = uniqueId;

      btn.addEventListener("click", () => {
        if (this.container) {
          removeToast(uniqueId, this.container);
        }
      });

      toast.append(btn);
    }

    this.container.prepend(toast);

    setTimeout(() => {
      toast.classList.add("show");
    }, 100);

    if (payload.timer || this.configurator.timer) {
      setTimeout(() => {
        if (this.container) {
          removeToast(uniqueId, this.container);
        }
      }, payload.timer ?? this.configurator.timer);
    }
  }
}
