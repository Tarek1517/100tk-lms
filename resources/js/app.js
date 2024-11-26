import '../css/app.css';
import '../css/font.css';
import '../css/main.css';
import './bootstrap';

import {createInertiaApp, Link} from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import Container from '@/Components/Container.vue';
import AppLayout from "@/Layouts/AppLayout.vue";
import Icon from '@/Components/Icon.vue'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .component('Container',Container)
            .component('AppLayout',AppLayout)
            .component('Icon',Icon)
            .component('Link',Link)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
