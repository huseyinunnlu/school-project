<template>
  <tr>
    <td>{{user.id}}</td>
    <td>{{user.fullName}}</td>
    <td>{{user.username}}</td>
    <td>{{user.email}}</td>
    <td>
      <span class="badge badge-primary" v-if="user.type == 0">User</span>
      <span class="badge badge-success" v-else>Admin</span>
    </td>
    <td>{{user.created_at}}</td>
    <td>
      <router-link :to="{name:'Profile',params:{username:user.username}}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></router-link>
    </td>
  </tr>
</template>
<script>
export default {
 props:['user']  
}
</script>