<template>
  <AddUser />
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between flex-wrap">
              <h3 class="card-title">
                <button
                  class="btn btn-primary btn-sm"
                  data-toggle="modal"
                  data-target="#addUser"
                >
                  <i class="fas fa-plus"></i>
                  Add User
                </button>
              </h3>
              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: auto;">
                  <input
                    type="text"
                    name="table_search"
                    class="form-control float-right"
                    placeholder="Search"
                    v-model="search"
                  />
                  <select class="form-control" v-model="column">
                    <option :value="null">Select Column</option>
                    <option :value="'fullName'">Name Surname</option>
                    <option :value="'username'">Username</option>
                    <option :value="'email'">Email</option>
                  </select>
                  <select class="form-control" v-model="type">
                    <option :value="null">Select User Type</option>
                    <option :value="'0'">User</option>
                    <option :value="'1'">Admin</option>
                  </select>
                  <select class="form-control" v-model="count" style="width:20px;">
                    <option :value="null">Select data count</option>
                    <option :value="'5'">5</option>
                    <option :value="'15'">15</option>
                    <option :value="'25'">25</option>
                    <option :value="'50'">50</option>
                    <option :value="'100'">100</option>
                  </select>
                  <select class="form-control" v-model="sort">
                    <option :value="null">Sort</option>
                    <option :value="'desc'">Creating Date DESC</option>
                    <option :value="'asd'">Creating Date ASC</option>
                  </select>
                  <div class="input-group-append">
                    <button @click="getUsers" type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name Surname</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>User Type</th>
                    <th>Created At</th>
                    <th>Opr.</th>
                  </tr>
                </thead>
                <tbody>
                  <UserLoader v-if="isLoading" />
                  <UserItem
                    v-else
                    v-for="user in _Users"
                    :key="user.id"
                    :user="user"
                  />
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import UserItem from "@/components/Adminpanel/User/UserItem.vue";
import AddUser from "@/components/Adminpanel/User/AddUser.vue";
import UserLoader from "@/components/Loaders/UserLoader.vue";
import { mapGetters } from "vuex";
export default {
  components: {
    UserItem,
    AddUser,
    UserLoader,
  },
  data() {
    return {
      search: "",
      column: "fullName",
      type: null,
      count: 15,
      sort: 'desc',
      isLoading: false,
    };
  },
  created() {
    this.getUsers();
  },
  methods: {
    getUsers() {
      this.isLoading = true;
      this.$appAxios
        .get("user/get", {
          params: {
            search: this.search,
            column: this.column,
            type: this.type,
            count: this.count,
            sort: this.sort,
          },
        })
        .then((res) => {
          this.$store.state.Users.users = res.data.data;
        })
        .catch(() => {
          this.$store.state.Users.users = [];
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
  computed: {
    ...mapGetters(["_Users"]),
  },
};
</script>
