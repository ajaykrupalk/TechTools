<template>
  <div class="w-96 flex justify-center items-center flex-col">
    <!-- To display validation errors -->

    <template v-if="success">
      <div class="flex flex-row gap-1 bg-green-100 p-3 rounded w-max-80 w-fit">
        <RocketLaunchIcon class="h-6 w-6 text-green-600" />

        <div class="text-wrap">
          <h3 class="text-xs text-green-600 font-semibold">Successful</h3>
          <p class="text-xs text-green-600 font-medium">
            You have successfully
            {{ registerForm ? "registered. Now you can log in" : "logged in" }}.
          </p>
        </div>
      </div>
      <!-- <div>Successful</div> -->
    </template>

    <template v-if="hasError">
      <div>
        <Validation :errors="errors" />
      </div>
    </template>

    <!-- Login or Signup -->
    <div>
      <h1 class="font-bold text-4xl m-3 text-center">
        {{ registerForm ? "Sign Up" : "Log In" }}
      </h1>

      <!-- Login with Google -->
      <div
        class="
          flex flex-row
          gap-1
          align-center
          border border-2 border-gray-200
          rounded
          p-1
          justify-center
          w-60
          hover:bg-gray-100
        "
        role="button"
      >
        <img
          src="https://www.freepnglogos.com/uploads/google-logo-png/google-logo-png-webinar-optimizing-for-success-google-business-webinar-13.png"
          alt="G"
          width="17"
          height="17"
        />
        <h3 class="text-xs font-semibold">Continue with Google</h3>
      </div>

      <!-- Login/Register Form -->
      <div class="block h-0.5 bg-gray-200 my-3 w-40 m-auto"></div>
      <form @submit.prevent="find">
        <div>
          <label for="email" class="text-xs text-slate-400">Email</label>
          <br />
          <!-- <input type="email" v-model="form.email" name="email" placeholder="Enter your email address"> -->
          <app-input
            v-model="form.email"
            type="email"
            @input="isEmpty"
            hint="Enter your email address"
            name="email"
          />
        </div>

        <template v-if="userExist || registerForm">
          <div>
            <label for="email" class="text-xs text-slate-400">Password</label>
            <br />
            <app-input
              v-model="form.password"
              type="password"
              hint="Enter your password"
              name="password"
            />
          </div>
        </template>

        <template v-if="registerForm">
          <div>
            <label for="email" class="text-xs text-slate-400"
              >Confirm Password</label
            >
            <br />
            <app-input
              v-model="form.password_confirmation"
              type="password"
              hint="Enter your password again"
              name="passwordConfirmation"
            />
          </div>
        </template>

        <div class="hover:bg-red-50">
          <button
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
              text-xs text-red-400
              font-semibold
            "
            type="submit"
          >
            {{ userExist ? "Continue with password" : "Continue with email" }}
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Password from "./Password.vue";
import SignUp from "./SignUp.vue";
import Validation from "./Validation.vue";
import AppInput from "../Dashboard/AppInput.vue";
import { RocketLaunchIcon } from "@heroicons/vue/24/outline";

import { User } from "../../services";

export default {
  name: "Login",

  data() {
    return {
      form: {
        email: "",
        password: "",
        password_confirmation: "",
      },
      userExist: false,
      registerForm: false,
      success: false,
      hasError: false,
      errors: [],
    };
  },

  methods: {
    async find() {
      User.get(this.form.email).then((response) => {
        if (response.data) {
          this.userExist = true;
          this.registerForm = false;
        } else {
          this.registerForm = true;
          this.userExist = false;
        }
      });

      if (this.registerForm) {
        await User.createSession();

        await User.register(this.form)
          .then((res) => {
            if (res.status === 201) {
              this.success = true;
              this.hasError = false;
            }
          })
          .catch((err) => {
            this.errors = err.response.data.errors;
            this.hasError = true;
          });
      }

      if (this.userExist && this.form.password.length > 0) {
        // await this.login();
        await User.createSession();
        try {
          // await this.$store.dispatch('login', this.form);
          await this.$router.push("/dashboard");
        } catch (err) {
          if (err.response && err.response.status === 401) {
            this.errors = ["Re-enter your email and password"];
            this.success = false;
            this.hasError = true;
          }
        }
      }

      // User.login(this.form)
      //   .then((response) => {
      //     if (response.status === 200) {
      //       console.log('User',response);
      //       this.success = true;
      //       this.userExist = false;
      //       this.hasError = false;
      //       // this.$store.dispatch('login', this.form);
      //       this.$router.push('/dashboard');
      //       this.form.email = "";
      //       this.form.password = "";
      //       this.form.password_confirmation = "";
      //     }
      //   })
      //   .catch((err) => {
      //     console.log(err);
      //     this.errors = ["Re-enter your email and password"];
      //     this.success = false;
      //     this.hasError = true;
      //   });
    },
  },
  async login() {
    await User.createSession();
    try {
      this.$store.dispatch("login", this.form);
      this.$router.push("/dashboard");
    } catch (err) {
      if (err.response && err.response.status === 401) {
        this.errors = ["Re-enter your email and password"];
        this.success = false;
        this.hasError = true;
      }
    }
  },
  isEmpty() {
    if (this.form.email === "") {
      this.userExist = false;
      this.registerForm = false;
    }
  },
  components: {
    Password,
    SignUp,
    Validation,
    AppInput,
    RocketLaunchIcon,
  },
};
</script>