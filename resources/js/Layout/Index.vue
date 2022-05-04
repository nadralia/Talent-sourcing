<template>
  <div class="relative flex min-h-screen">
    <alert />
    <!-- left sidebar -->
    <div class="w-64 bg-white border-l">
      <!-- logo -->
      <div class="p-6">
        <application-mark class="w-40"></application-mark>
      </div>

      <side-nav></side-nav>
    </div>

    <!-- main content -->
    <div class="flex-1 bg-purple-50">
      <!-- top bar -->
      <content-area-top-bar></content-area-top-bar>

      <!-- main content -->
      <div class="px-4">
        <slot></slot>
      </div>
    </div>
  </div>
</template>

<script>
import ApplicationMark from "../Shared/ApplicationMark.vue";
import SideNav from "./components/SideNav.vue";
import ContentAreaTopBar from "./components/TopBar.vue";
import SearchInput from "../Shared/SearchInput.vue";
import Alert from "../Shared/Alert.vue";
export default {
  components: {
    ApplicationMark,
    SideNav,
    ContentAreaTopBar,
    SearchInput,
    Alert,
  },
};
</script>