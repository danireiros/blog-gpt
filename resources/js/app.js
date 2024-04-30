import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

// PLUGINS
// de bounce
import vueDebounce from 'vue-debounce'

// oruga
import Oruga from '@oruga-ui/oruga-next';
import { bulmaConfig } from '@oruga-ui/theme-bulma'

// ckeditor
import CKEditor from '@ckeditor/ckeditor5-vue';

import '@oruga-ui/theme-bulma/dist/bulma.css'

const appName = import.meta.env.VITE_APP_NAME || 'InfoParaTi';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(Oruga, bulmaConfig)
            .use(CKEditor)
            .directive('debounce', vueDebounce({ lock: true }))
            .mount(el);
    },
    progress: {
        color: '#6875F5',
    },
    //progress: false,
});
