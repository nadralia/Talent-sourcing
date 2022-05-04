<template>
  <div class="bg-blue-50 border hover:shadow p-3 rounded-lg space-y-3">
    <p class="text-sm font-semibold">{{ JobDescription }}</p>
    <div class="flex items-center justify-between text-xs">
      <div class="flex items-center space-x-1 text-gray-600">
        <bhr-icon name="user-circle" class="text-yellow-500"></bhr-icon>
        <span>{{ candidates }} candidates</span>
      </div>
      <div class="flex items-center space-x-1 text-gray-600">
        <bhr-icon name="calendar" class="text-yellow-500"></bhr-icon>
        <span>{{ experience }} years exp.</span>
      </div>
    </div>
    <div class="flex flex-wrap">
      <span
        v-for="language in languages"
        :key="language"
        class="bg-blue-400 py-1 px-2 rounded text-white text-tiny mr-2 mt-2"
      >
        {{ language }}
      </span>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    JobDescription: String,
    languages: Array,
    experience: Number,
    candidates: Number,
  },
};
</script>