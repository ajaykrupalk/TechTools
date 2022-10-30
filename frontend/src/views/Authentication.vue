<template>
  <div class="flex justify-center bg-gray-50 h-screen">
    <Login />
  </div>
</template>

<script>
import Login from '../components/Auth/Login.vue';

export default {
    name: 'Authentication',
    components: {
        Login,
    }
}
</script>