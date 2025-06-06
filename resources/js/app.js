import '../css/app.css';
import './bootstrap';

import Notification from './Components/Notification.vue';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import GlobalComponent from '@/plugins.js'
import { createApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { reactive } from "vue";
import './../css/styles/index.css'
import './../css/styles/partials/auth.css'
import './../css/styles/partials/header.css'
import './../css/styles/cars.css'
import './../css/styles/categories.css'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: () => `${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(GlobalComponent)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
