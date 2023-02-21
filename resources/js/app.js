/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
import Vue from 'vue'
import ElementUI from 'element-ui'
import Resource from 'vue-resource'
import VueRouter from 'vue-router'
import Bars from 'vuebars'
import vueEventCalendar from 'vue-event-calendar'
import routes from './routes'
import VueAnimateNumber from 'vue-animate-number'
import VueGmaps from 'vue-gmaps'
import VueLayers from 'vuelayers'
import VCharts from 'v-charts'
import Vuelidate from 'vuelidate'
import VueCookies from 'vue-cookies'
// import VueMoment from 'vue-moment'
import locale from 'element-ui/lib/locale/lang/en'
import store from './store'

import { ElementTiptapPlugin } from 'element-tiptap'


Vue.use(Resource)
Vue.http.options.emulateJSON = true
Vue.use(VueRouter)
Vue.use(ElementUI, { locale })
Vue.use(ElementTiptapPlugin, {
  lang: 'en',
});
Vue.use(Bars)
Vue.use(vueEventCalendar, {locale: 'en'})
Vue.use(VueAnimateNumber)
Vue.use(VueGmaps, {
  key: 'AIzaSyCpr35b_ZSoP8nbz0VnBjVz6ABb7iurRCU',
  libraries: ['places'],
  version: '3'
})
Vue.use(VueLayers)
Vue.use(VCharts)
Vue.use(VueCookies)
Vue.use(require('vue-moment'))
Vue.use(Vuelidate);


// Added by Leo
import vueCountryRegionSelect from 'vue-country-region-select'
Vue.use(vueCountryRegionSelect)

window.Vue = require('vue');
import 'bootstrap/dist/css/bootstrap.css'
import 'element-ui/lib/theme-chalk/index.css'
import 'material-design-icons/iconfont/material-icons.css'
import 'dripicons/webfont/webfont.css'
import 'vuelayers/lib/style.css'
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('home', require('./components/App.vue').default);
Vue.component('dashboard', require('./components/Dashboard.vue').default);
// Vue.component('register', require('./components/modules/pcr_convention/Registration.vue').default);
// Vue.component('register', require('./components/modules/site/Registration.vue').default);
// Vue.component('login', require('./components/modules/pcr_convention/Login.vue').default);
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
if (window.localStorage) {
    if (store.state.token !== window.localStorage.getItem('token')) {
      store.commit('SET_TOKEN', window.localStorage.getItem('token'))
    }
  }

// Routing logic
var router = new VueRouter({
    routes: routes,
    mode: 'history',
    linkActiveClass: 'open active',
    scrollBehavior: function (to, from, savedPosition) {
      return savedPosition || { x: 0, y: 0 }
    }
  })

const app = new Vue({
    el: '#app-container',
    store,
    router
});
// require('bootstrap')
// require('admin-lte')
require('../../node_modules/admin-lte/plugins/slimScroll/jquery.slimscroll.js')
require('../../node_modules/admin-lte/dist/js/app.js')
require('../../node_modules/admin-lte/dist/js/demo.js')
