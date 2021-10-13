import { createStore } from "vuex";
import User from "./modules/User";
import Users from "./modules/Admin/Users";
const store = createStore({
  modules: {
    User,
    Users
  },
});

export default store;
