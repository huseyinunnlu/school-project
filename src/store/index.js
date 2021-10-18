import { createStore } from "vuex";
import User from "./modules/User";
import Settings from "./modules/Settings";
import Users from "./modules/Admin/Users";
const store = createStore({
  modules: {
    User,
    Users,
    Settings,
  },
});

export default store;
