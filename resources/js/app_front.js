import Vue from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
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



import VueMask from 'v-mask'

Vue.use(VueMask);


Vue.component('form-proposal', require('./Front/FormProposal.vue').default);
Vue.component('form-proposal-biz', require('./Front/FormProposalBiz.vue').default);
/* FormProposal.vue */


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

const app = new Vue({
    el: '#app',

});