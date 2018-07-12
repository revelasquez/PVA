require('./bootstrap')

import Vue from 'vue'
import Resource from 'vue-resource'
import VueRouter from 'vue-router'
import Vuex from 'vuex'
import VeeValidate, { Validator } from 'vee-validate'
import {routes} from './routes'
import StoreData from './store'
import AppMain from './components/AppMain.vue'
import es from 'vee-validate/dist/locale/es'

import toastr from 'toastr'
import 'toastr/build/toastr.min.css'
Vue.prototype.toastr = toastr

import fontawesome from '@fortawesome/fontawesome';
import fas from '@fortawesome/fontawesome-free-solid';
import fab from '@fortawesome/fontawesome-free-brands';
fontawesome.library.add(fas, fab);

Vue.use(VueRouter)
Vue.use(Resource)
Vue.use(Vuex)

Validator.localize({
  es: es
})
Vue.use(VeeValidate, {
  locale: 'es',
})

const store = new Vuex.Store(StoreData)

const router = new VueRouter({
  routes,
  // hashbang: false,
  mode: 'history',
})

router.beforeEach((to, from, next) => {
  const requiresAuth = to.matched.some(record => record.meta.requiresAuth)
  const currentUser = store.state.currentUser

  if (requiresAuth && !currentUser) {
    next({
      path: '/login'
    })
  } else if (to.path == '/login' && currentUser) {
    next({
      path: '/'
    })
  } else {
    next()
  }
})

new Vue({
  el: '#app',
  router,
  store,
  components: {
    AppMain
  },
  locale : 'es',
})
