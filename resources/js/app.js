require('./bootstrap');

// Import modules...
import {createApp, h} from 'vue';
import {App as InertiaApp, plugin as InertiaPlugin} from '@inertiajs/inertia-vue3';
import {InertiaProgress} from '@inertiajs/progress';

import {createI18n} from 'vue-i18n/index'
import ES from './../lang/es';

const i18n = createI18n({
    messages: {
        es: ES
    },
    locale: 'es'
});

const el = document.getElementById('app');

const app = createApp({
        render: () => h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
    }
)
    .mixin({methods: {route}})
    .use(InertiaPlugin)
    .use(i18n);

app.config.globalProperties.$filter = {
    currency(amount) {
        const options2 = {style: 'currency', currency: 'COP'};
        const numberFormat2 = new Intl.NumberFormat('es-CO', options2);

        return numberFormat2.format(amount).replace(',00', '');
    }
}

app.mount(el);

InertiaProgress.init({color: '#4B5563'});
