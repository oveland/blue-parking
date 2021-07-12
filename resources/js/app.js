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
    })
    .mixin({methods: {route}})
    .use(InertiaPlugin)
    .use(i18n)
    .mount(el);

    /* Init Filters */
    // .filter('capitalize', function (value) {
    //     if (!value) return ''
    //     value = value.toString()
    //     return value.charAt(0).toUpperCase() + value.slice(1)
    // })
    // .filter('currency', function (amount) {
    //     const options2 = {style: 'currency', currency: 'COP'};
    //     const numberFormat2 = new Intl.NumberFormat('es-CO', options2);
    //
    //     return numberFormat2.format(amount);
    // })
    // .filter('uppercase', function (value) {
    //     if (!value) return ''
    //     return value.toString().toUpperCase()
    // })
    // .mixin({
    //     mounted: function () {
    //         if (this.form) {
    //             this.form.inertiaPage().errorBags[this.form.__options.bag] = [];
    //         }
    //     },
    //     methods: {
    //         can(permission) {
    //             return this.$page.auth.can[permission];
    //         }
    //     }
    // });


InertiaProgress.init({color: '#4B5563'});
