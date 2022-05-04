<template>
  <div
    v-if="show && flash"
    class="p-3 space-x-4 fixed top-10 right-10 flex items-start z-50"
    :class="classes[flash.type]"
  >
    <div>
      <bhr-icon name="exclamation-circle" />
    </div>
    <div class="flex-1">
      <p class="font-semibold">{{ flash.title }}</p>
      <p>{{ flash.message }}</p>
    </div>
    <div>
      <button @click="close"><bhr-icon name="x" /></button>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      show: false,

      flash: null,

      classes: {
        error: "bg-red-100 border-1 border-red-200 text-red-800",
        success: "bg-green-50 border-1 border-green-200 text-green-800",
        info: "bg-blue-50 border-1 border-blue-200 text-blue-800",
      },
    };
  },
  watch: {
    "$app.flash": {
      handler() {
        this.setAlert(this.$app.flash);
        setTimeout(() => {
          this.close();
        }, 10000);
      },
      deep: true,
    },
  },
  methods: {
    close() {
      this.$app.flash = null;
      this.show = false;
    },

    setAlert(flash) {
      this.show = true;
      this.flash = flash;
    },
  },
};
</script>