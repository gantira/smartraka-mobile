require('./bootstrap');

// Import modules...
import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import moment from "moment";

const el = document.getElementById('app');

createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
})
    .mixin({ methods: { route } })
    .mixin({
        methods: {
            formatDate(date) {
                return moment(date).locale("id").format("D MMMM, Y");
            },
            formatRupiah(money)  {
                return new Intl.NumberFormat('id-ID',
                  { style: 'currency', currency: 'IDR', minimumFractionDigits: 2 }
                ).format(money);
            }
        }
    })
    .use(InertiaPlugin)
    .mount(el);

// InertiaProgress.init({ color: '#4B5563' });
