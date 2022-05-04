<template>
  <div>
    <div class="flex flex-col items-center space-y-4">
      <div
        class="
          flex
          h-12
          w-12
          rounded-full
          items-center
          justify-center
          border-1
          bg-orange-100
          text-orange-600
          border-orange-600
        "
      >
        <span class="text-xl">{{ recruiter.initials }} </span>
      </div>
      <p>{{ recruiter.name }}</p>
      <span class="text-xs text-gray-600">{{ recruiter.description }}</span>
      <span class="text-xs text-gray-600">{{ recruiter.email }}</span>
    </div>
    <div class="mt-4 text-xs">
      <div class="flex justify-between">
        <p>Tasks</p>
        <p>Hired</p>
      </div>
      <div class="flex justify-between mt-2">
        <p>{{ recruiter.tasks }}</p>
        <p>{{ recruiter.hired }}</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    recruiter: Object,
  },
};
</script>