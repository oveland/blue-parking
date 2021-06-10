require('./bootstrap');

// Import modules...
import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

// import VueI18n from 'vue-i18n'
// import i18n from "./lang/i18n";

const el = document.getElementById('app');

const Vue = createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
})
    .mixin({ methods: { route } })
    .use(InertiaPlugin)
    // .use(VueI18n)
    .mount(el);

// import ES from './../lang/es';
//
// const messages = {
//     es: ES
// };
//
// const i18n = new VueI18n({
//     messages,
//     locale: 'es'
// });


InertiaProgress.init({ color: '#4B5563' });
