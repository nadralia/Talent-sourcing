<template>
  <div class="flex items-center h-5">
    <input
      :id="id"
      :name="name"
      :type="type"
      class="
        focus:ring-indigo-500
        h-4
        w-4
        text-indigo-600
        border-gray-300
        rounded
      "
    />
  </div>
</template>

<script>
export default {
  props: {
    type: {
      type: String,
      default: "checkbox",
    },
    name: String,
    id: String | Number,
  },
};
</script>