import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import MainLayout from '@/Layouts/MainLayout.vue'
import {InertiaProgress} from '@inertiajs/progress'
import {useToast} from 'vue-toastification'
import 'vue-toastification/dist/index.css'
import { Bootstrap4Pagination } from 'laravel-vue-pagination';
import { Bootstrap5Pagination } from 'laravel-vue-pagination';
import { TailwindPagination } from 'laravel-vue-pagination';
createInertiaApp({
  resolve: async name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    const page = await pages[`./Pages/${name}.vue`]
    page.default.layout = page.default.layout || MainLayout
    return page
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(InertiaProgress)
      .use(useToast)
      .use(Bootstrap4Pagination)
      .use(Bootstrap5Pagination)
      .use(TailwindPagination)
      .mount(el)
  },
  progress: {
    // The delay after which the progress bar will appear, in milliseconds...
    delay: 0,

    // The color of the progress bar...
    color: '#29d',

    // Whether to include the default NProgress styles...
    includeCSS: true,

    // Whether the NProgress spinner will be shown...
    showSpinner: true,
  },
})