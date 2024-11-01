import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import NProgress from 'nprogress'
import { router } from '@inertiajs/vue3'
import { ZiggyVue } from 'ziggy';
import Highcharts from "highcharts";
import Maps from "highcharts/modules/map";
import HighchartsVue from "highcharts-vue";


Maps(Highcharts);

createInertiaApp({
    title: title => `${title} - My App`,
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(HighchartsVue)
            .mount(el)
    },
    progress: {
        // The delay after which the progress bar will appear, in milliseconds...
        delay: 250,

        // The color of the progress bar...
        color: 'hsl(var(--primary))',

        // Whether to include the default NProgress styles...
        includeCSS: true,

        // Whether the NProgress spinner will be shown...
        showSpinner: true,
    },
})

router.on('start', () => NProgress.start())
router.on('finish', () => NProgress.done())
