import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";
import eslintPlugin from "vite-plugin-eslint";
import path from "path";

const resolve = (dir: string): string => {
  return path.join(__dirname, dir);
};

export default defineConfig({
  server: {
    host: "0.0.0.0",
  },
  plugins: [vue(), eslintPlugin()],
  resolve: {
    alias: {
      "@assets": resolve("./src/assets"),
      "@components": resolve("./src/components"),
      "@interfaces": resolve("./src/interfaces"),
      "@directives": resolve("./src/directives"),
      "@services": resolve("./src/services"),
      "@mixins": resolve("./src/mixins"),
      "@router": resolve("./src/router"),
      "@stores": resolve("./src/stores"),
      "@utils": resolve("./src/utils"),
      "@screens": resolve("./src/screens"),
    },
  },
});
