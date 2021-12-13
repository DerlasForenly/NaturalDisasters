import { createApp, h } from 'vue'
import store from './store'
import App from './App.vue'

const app = createApp({
	render: () => h(App)
})
app.use(store).mount('#app')
