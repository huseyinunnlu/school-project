<template>
  <tr v-if="!isDeleted">
    <td>{{ user.id }}</td>
    <td>{{ user.fullName }}</td>
    <td>{{ user.username }}</td>
    <td>{{ user.email }}</td>
    <td>
      <span class="badge badge-primary" v-if="user.type == 0">User</span>
      <span class="badge badge-success" v-else>Admin</span>
    </td>
    <td>{{ user.created_at }}</td>
    <td>
      <router-link
        :to="{ name: 'UserEdit', params: { id: user.id } }"
        class="btn btn-primary btn-sm"
        ><i class="fas fa-pen"></i
      ></router-link>
      <router-link
        :to="{ name: 'Profile', params: { username: user.username } }"
        class="btn btn-primary btn-sm"
        ><i class="fas fa-eye"></i
      ></router-link>
      <button
        data-toggle="modal"
        data-target=".deletemModal"
        :to="{ name: 'Profile', params: { username: user.username } }"
        class="btn btn-danger btn-sm"
      >
        <i class="fas fa-trash"></i>
      </button>
    </td>

    <div
      class="modal fade deletemModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="mySmallModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-body">
            <div
              class="container my-3 text-center d-flex flex-column justify-content-center"
            >
              <h4>Are sou sure to delete</h4>
              <div
                class="d-flex justify-content-center justify-content-around mt-3"
              >
                <button
                  data-dismiss="modal"
                  aria-label="Close"
                  class="btn btn-secondary"
                >
                  No
                </button>
                <button
                  v-if="!isLoading"
                  @click="deleteUser()"
                  class="btn btn-danger"
                >
                  Yes
                </button>
                <button v-else disabled class="btn btn-danger">
                  Deleting
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </tr>
</template>
<script>
export default {
  data() {
    return {
      isDeleted: false,
      isLoading: false,
    };
  },
  methods: {
    deleteUser() {
      this.isLoading = true;
      this.$appAxios
        .delete("/user/" + this.user.id + "/delete")
        .then(() => {
          this.isDeleted = true;
          this.$notify({
            type: "success",
            title: "User successfuly deleted.",
          });
        })
        .catch(() => {
          this.$notify({
            type: "error",
            title: "User didn't deleted.",
          });
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
  props: ["user"],
};
</script>
