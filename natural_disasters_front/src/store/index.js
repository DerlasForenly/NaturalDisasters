import { createStore } from "vuex"
import categoriesModule from "./categoriesModule"
import disastersModule from "./disastersModule"

export default createStore({
  modules: {
    disasters: disastersModule,
    categories: categoriesModule,
  }
})