import Vue from 'vue'
import App from './App.vue'
import VueMask from 'v-mask'
import store from './store/store';
import {BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import Toast from "vue-toastification";
// Import one of available themes
import "vue-toastification/dist/index.css";
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
const options = {
  // You can set your default options here
};



Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.use(Toast, options);
Vue.use(VueMask);
Vue.config.productionTip = false

new Vue({
  store,
  render: h => h(App)
}).$mount('#app')
