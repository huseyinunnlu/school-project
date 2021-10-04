import { createStore } from "vuex";
import User from "./modules/User";
const store = createStore({
  modules: {
    User,
  },
});

export default store;
