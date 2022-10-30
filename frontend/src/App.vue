<template>
  <router-view></router-view>
  <!-- <AddForm /> -->
</template>

<script>
import Authentication from "./views/Authentication.vue";
import DashboardLayout from "./views/DashboardLayout.vue";
import AddForm from './components/Admin/addForm.vue';

export default {
  name: "App",
  components: {
    DashboardLayout,
    Authentication,
    AddForm,
  },
};
</script>