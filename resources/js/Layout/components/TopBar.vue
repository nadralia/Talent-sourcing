<template>
  <div class="bg-white px-4 py-2 flex">
    <!-- left -->
    <div class="flex-1 flex items-center text-xl font-semibold space-x-3">
      <bhr-icon name="chevron-left"></bhr-icon>
      <span class="capitalize">{{ $route.name }}</span>
    </div>

    <!-- middle -->
    <div class="flex-1 flex items-center justify-center">
      <search-input class="w-full"></search-input>
    </div>

    <!-- right -->
    <div class="flex-1 flex items-center justify-between">
      <!-- Notification bell -->
      <notification-bell></notification-bell>

      <!-- user icon and name -->
      <div class="flex items-center">
        <div class="mr-2 text-right">
          <p class="font-semibold">Grace Gupa</p>
          <p class="text-xs text-gray-500">Supervisor</p>
        </div>
        <div
          class="h-12 w-12 rounded-full border border-yellow-800 bg-yellow-500"
        ></div>
      </div>
    </div>
  </div>
</template>

<script>
import SearchInput from "../../Shared/SearchInput.vue";
import NotificationBell from "./NotificationBell.vue";
export default {
  components: {
    SearchInput,
    NotificationBell,
  },
};
</script>