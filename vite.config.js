import {resolve} from "path";
import {defineConfig} from "vite";
import legacy from "@vitejs/plugin-legacy";
import basicSsl from "@vitejs/plugin-basic-ssl";
import liveReload from "vite-plugin-live-reload";
import getThemeDir from "./inc/js-helpers/getThemeDir.mjs"; // https://vitejs.dev/config/

// https://vitejs.dev/config/
export const viteConfig = {
	cacheDir: "./node_modules/.vite/press-wind",
	plugins: [basicSsl(), liveReload([`${__dirname}+ "/**/*.php`]), legacy({})],
	base:
		process.env.APP_ENV === "development"
			? `/wp-content/themes/${getThemeDir()}/`
			: `/wp-content/themes/${getThemeDir()}/dist/`,
	root: "",
	// css: {
	// 	transformer: "lightningcss",
	// 	lightningcss: {
	// 		targets: browserslistToTargets(browserslist(">= 0.25%")),
	// 	},
	// },
	build: {
		cssCodeSplit: true,
		cssMinify: "lightningcss",
		// output dir for production build
		outDir: resolve(__dirname, "dist"),
		emptyOutDir: true,
		manifest: true,
		rollupOptions: {
			input: resolve(__dirname, "main.js"),
		},
	},
	server: {
		cors: true,
		strictPort: true,
		port: 3000,
		https: true,
		hmr: {
			protocol: "wss",
			port: 3000,
			// host: 'localhost',
		},
	},
};

export default defineConfig(viteConfig);
