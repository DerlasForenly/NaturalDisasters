import Vue from 'vue'
import App from './App.vue'
import store from './store'

Vue.config.productionTip = false

const app = new Vue({
  render: h => h(App),
}).$mount('#app')

app.use(store)
