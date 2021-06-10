import VueI18n from "vue-i18n";

import ES from './../../lang/es';

const messages = {
    es: ES
};

const i18n = new VueI18n({
    messages,
    locale: 'es'
});

export default i18n;
