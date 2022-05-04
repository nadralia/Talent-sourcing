<template>
  <div class="relative min-h-screen flex bg-white">
    <alert />
    <div
      class="flex-1 bg-top bg-cover bg-no-repeat bg-blue-50"
      style="background-image: url('/assets/images/login-art.png')"
    ></div>
    <div class="flex-1 p-28">
      <application-mark class="w-48" />

      <div class="mt-20">
        <p class="font-bold text-3xl">Log In To Borderless</p>

        <form class="mt-12 mr-64 min" @submit.prevent="handleLoginAsync">
          <bhr-text-input
            :error="
              form.errors.errors.email ? form.errors.errors.email[0] : null
            "
            v-model="form.email"
            type="email"
            label="Email Address"
          />
          <bhr-text-input
            v-model="form.password"
            :error="
              form.errors.errors.password
                ? form.errors.errors.password[0]
                : null
            "
            type="password"
            label="Password"
            class="mt-12"
          />
          <div class="flex justify-between mt-6">
            <div class="flex items-center">
              <bhr-checkbox name="remember" id="remember" />
              <label class="ml-2" for="remember">Keep me logged in</label>
            </div>
            <div>
              <a href="#" class="text-blue-500 underline">Forgot password?</a>
            </div>
          </div>
          <div class="flex justify-center mt-12">
            <bhr-button :loading="form.busy" class="text-xl">Log in</bhr-button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import Form from "vform";
import ApplicationMark from "../../Shared/ApplicationMark.vue";
import Alert from "../../Shared/Alert.vue";
export default {
  components: {
    ApplicationMark,
    Alert,
  },

  data() {
    return {
      form: new Form({
        email: "",
        password: "",
      }),
    };
  },

  methods: {
    async handleLoginAsync() {
      try {
        const { data } = await this.form.post(
          `${this.$app.BASE_URL}/api/v1/talents/auth`
        );

        localStorage._talent = JSON.stringify(data.data);

        Flash({
          type: "success",
          title: "Authentication successful",
        });

        this.$router.push({ name: "dashboard" });
      } catch ({ response }) {
        if (response.data.message) {
          Flash({
            type: "error",
            title: "Unable to authenticate",
            message: response.data.message,
          });
        }
      }
    },
  },
};
</script>