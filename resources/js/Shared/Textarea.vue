<template>
  <div>
    <!-- error label -->
    <label
      v-if="error"
      for="first-name"
      class="block font-semibold mb-1 bg-red-500 text-white py-1 px-2"
    >
      {{ error }}
    </label>

    <!-- input label -->
    <div class="flex items-center space-x-1">
      <bhr-icon v-if="error" name="exclamation-circle-solid" />
      <label
        for="first-name"
        class="block text-sm font-semibold mb-1"
        v-if="label"
      >
        {{ label }}
      </label>
    </div>
    <textarea
      :type="type"
      :name="name"
      :id="id"
      :autocomplete="autocomplete"
      class="border-1 focus:border-blue-500 block w-full rounded px-3 py-2"
      :class="`${inputClass} ${!!error ? 'border-red-500' : 'border-gray-300'}`"
      :placeholder="placeholder"
      :value="value"
      @input="handleInput"
    />
  </div>
</template>

<script>
export default {
  props: {
    inputClass: String,
    type: {
      type: String,
      default: "text",
    },
    autocomplete: String,
    name: String,
    id: String | Number,
    placeholder: String,
    label: String,
    value: String | Number | Object,
    error: String | Boolean,
  },

  // data() {
  //   return {
  //     content: this.value,
  //   };
  // },

  methods: {
    handleInput(e) {
      this.$emit("input", e.target.value);
    },
  },
};
</script>