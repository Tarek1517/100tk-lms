import "../css/app.css";
import "../css/font.css";
import "../css/main.css";
import "./bootstrap";


import { createInertiaApp, Link } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { createApp, h } from "vue";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import Container from "@/Components/Container.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Icon from "@/Components/Icon.vue";
import Vue3Toastify from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import vSelect from "vue-select"; // Import vue-select
import "vue-select/dist/vue-select.css"; // Import styles for vue-select

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => {
        console.log(`Resolving component: ${name}`);
        return resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        );
    },
    setup({ el, App, props, plugin }) {
        // Create Vue app once
        const app = createApp({ render: () => h(App, props) });

        // Use plugins and register global components
        app.use(plugin)
            .use(ZiggyVue)
            .use(Vue3Toastify, {
                autoClose: 5000, // Auto-close after 5 seconds
                position: "top-right", // Toast position
                hideProgressBar: true, // Optionally hide progress bar
            })
            .component("Container", Container)
            .component("AppLayout", AppLayout)
            .component("Icon", Icon)
            .component("Link", Link) // Inertia Link component
            .component("v-select", vSelect) // Globally register v-select
            .mount(el); // Mount to the DOM element

        return app;
    },
    progress: {
        color: "#4B5563", // Progress bar color
    },
});
