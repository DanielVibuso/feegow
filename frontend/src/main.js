// Vue
import Vue from 'vue'
import App from './App.vue'
// Config
import './registerServiceWorker'
// Vue Router
import router from './router'
// Axios
import api from './axios'
// Bootstrap
import { BootstrapVue } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'


// Vuelidate
import Vuelidate from 'vuelidate'
// Vue Input Mask
import VueMask from 'v-mask'
// Styles (CSS)
import "./assets/css/styles.css"

import mitt from 'mitt'

const emitter = mitt()
//avoiding props hell
Vue.prototype.$emitter = emitter 
Vue.prototype.$http = api

Vue.use(BootstrapVue)
Vue.use(Vuelidate)
Vue.use(VueMask)

Vue.config.productionTip = false

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')
