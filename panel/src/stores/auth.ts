import { defineStore } from "pinia";
import { IAdmin } from "@interfaces/IAdmin";
export interface IRememberState {
  enabled: boolean;
  email: string;
  password: string;
}

export type IAdminState = IAdmin;

export interface IAuthState {
  remember: IRememberState;
  user: IAdminState;
  jwt: string;
}

const storageKey = {
  remember: "AUTH_REMEMBER",
  user: "AUTH_USER",
  jwt: "AUTH_JWT",
};

export const useAuthStore = defineStore("auth", {
  state: (): IAuthState => {
    let remember = {
      enabled: false,
      email: "",
      password: "",
    };

    const rememberStorage = localStorage.getItem(storageKey.remember);

    if (rememberStorage) {
      remember = JSON.parse(rememberStorage);
    }

    let user = {
      id: "",
      email: "",
      name: "",
    };

    const userStorage = localStorage.getItem(storageKey.user);

    if (userStorage) {
      user = JSON.parse(userStorage);
    }

    const jwt = localStorage.getItem(storageKey.jwt) ?? "";

    return {
      remember,
      user,
      jwt,
    };
  },
  getters: {
    getRememberState: (state: IAuthState) => {
      return state.remember;
    },
    getUserState: (state) => {
      return state.user;
    },
    getJWTState: (state) => {
      return state.jwt || null;
    },
  },
  actions: {
    updateRememberState(payload: IRememberState) {
      this.remember = { ...payload };

      if (!this.remember.enabled) {
        localStorage.removeItem(storageKey.remember);
      } else {
        localStorage.setItem(
          storageKey.remember,
          JSON.stringify(this.remember)
        );
      }
    },
    updateUserState(payload: IAdminState) {
      this.user = { ...payload };

      if (!this.user.id) {
        localStorage.removeItem(storageKey.user);
      } else {
        localStorage.setItem(storageKey.user, JSON.stringify(this.user));
      }
    },
    updateJWTState(payload: string) {
      this.jwt = payload;
      localStorage.setItem(storageKey.jwt, this.jwt);
    },
  },
});
