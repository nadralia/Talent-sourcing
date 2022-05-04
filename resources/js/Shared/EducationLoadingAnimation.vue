<template>
  <div class="flex items-start space-x-2">
    <div class="">
      <VueSkeletonLoader
        type="circle"
        :width="50"
        :height="50"
        animation="wave"
      />
    </div>
    <div class="space-y-2">
      <VueSkeletonLoader
        type="rect"
        :width="200"
        :height="15"
        animation="wave"
      />
      <VueSkeletonLoader
        type="rect"
        :width="500"
        :height="15"
        animation="wave"
      />
      <VueSkeletonLoader
        type="rect"
        :width="500"
        :height="15"
        animation="wave"
      />

      <VueSkeletonLoader
        type="rect"
        :width="200"
        :height="15"
        animation="wave"
      />
    </div>
  </div>
</template>

<script>
import VueSkeletonLoader from "skeleton-loader-vue";

export default {
  components: {
    VueSkeletonLoader,
  },
};
</script>