import Vue from 'vue'
import VueMeta from 'vue-meta'
import PortalVue from 'portal-vue'
import { InertiaApp } from '@inertiajs/inertia-vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
import { asset } from '@codinglabs/laravel-asset'
window.axios = axios;
window.Vue = require('vue');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*';
let token = document.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
    window.token_csrf = token.content;
    // window.axios.defaults.headers.head['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

Vue.use(VueAxios, axios)

Vue.config.productionTip = false
Vue.config.devtools = false
Vue.mixin({ methods: { route: (...args) => window.route(...args).url(), asset: asset } })
    //Vue.mixin({ methods: { route: window.route, asset: asset } })

var filter = function(text, length, clamp) {
    clamp = clamp || '...';
    return text.length > length ? text.slice(0, length) + clamp : text;
};

Vue.filter('truncate', filter);

Vue.use(InertiaApp)
Vue.use(PortalVue)
Vue.use(VueMeta)

import VueMask from 'v-mask'

Vue.use(VueMask);

let app = document.getElementById('app');


Vue.mixin({
    data: function() {
        return {
            langs: window.langs,
            defaultlocale: window.deflocale,
            fields: {
                defaultLang: '',
                currentLang: '',
                textTranslate: ''
            },
            token_csrf: window.token_csrf,
        }
    },


})
new Vue({
    metaInfo: {
        titleTemplate: (title) => title ? `${title} - Tattoo Collection` : 'Tattoo Collection'
    },
    render: h => h(InertiaApp, {
        props: {
            initialPage: JSON.parse(app.dataset.page),
            resolveComponent: name =>
                import (`@/Pages/${name}`).then(module => module.default),
        },
    }),
}).$mount(app)