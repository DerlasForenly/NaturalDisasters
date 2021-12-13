import { createStore } from "vuex"
import disastersModule from "./disastersModule"

export default createStore({
  modules: {
    disasters: disastersModule
  }
})