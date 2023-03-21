import "vue-router";
declare module "vue-router" {
  interface RouteMeta {
    authenticated?: boolean;
    title: string;
    navbar?: boolean;
    navbarLabel?: string;
  }
}
