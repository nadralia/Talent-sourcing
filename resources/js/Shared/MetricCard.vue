<template>
  <div
    class="bg-white shadow-sm rounded-lg p-3 flex items-center justify-between"
  >
    <div>
      <p class="text-xs text-gray-500">{{ name }}</p>
      <p class="font-bold text-xl">{{ count }}</p>
    </div>
    <div
      class="rounded-full h-10 w-10 flex items-center justify-center"
      :class="bgColor"
    >
      <bhr-icon :name="icon" :class="textColor"></bhr-icon>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    name: String,
    count: String | Number,
    textColor: {
      type: String,
      default: "text-blue-800",
    },
    bgColor: {
      type: String,
      default: "bg-blue-100",
    },
    icon: String,
  },
};
</script>