import { createRouter, createWebHistory, RouteRecordRaw } from "vue-router";
import { useAuthStore } from "@stores/auth";

const appTitle = import.meta.env.VITE_APP_TITLE;

const defaultRoute = "Home";
const signInRoute = "AuthSignIn";

export const routes: Array<RouteRecordRaw> = [
  {
    path: "/:pathMatch(.*)*",
    redirect: {
      name: defaultRoute,
    },
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  const store = useAuthStore();

  if (to.matched.some((record) => record.meta.authenticated)) {
    if (!store.getJWTState) {
      next({
        name: signInRoute,
        query: { redirect: to.fullPath },
      });

      return;
    }
  }

  next();
});

router.afterEach((to) => {
  document.title = `${appTitle} | ${to.meta.title}`;
});

export default router;
