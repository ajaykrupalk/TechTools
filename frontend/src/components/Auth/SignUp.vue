<template>
  <form action="">
    <label for="password" class="text-xs text-slate-400">Password</label>
    <br />
    <AppInput type="password" hint="Enter your password" />
    <br />
    <label for="cpassword" class="text-xs text-slate-400">Confirm Password</label>
    <br />
    <AppInput type="password" hint="Confirm your password" />
    <!-- <a href="#">
      <div
        class="
          mt-3
          flex flex-row
          gap-1
          border border-1 border-red-400
          bg-red-50
          rounded
          p-1
          justify-center
          w-60
          hover:bg-red-100
        "
        role="button"
      >
        <h3 class="text-xs text-red-400 font-semibold">
          Continue with password
        </h3>
      </div>
    </a> -->
  </form>
</template>

<script>
import AppInput from "../Dashboard/AppInput.vue";

export default {
  name: "Password",
  components: {
    AppInput,
  },
};
</script>