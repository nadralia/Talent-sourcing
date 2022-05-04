<template>
  <nav>
    <ul>
      <li v-for="item in navItems" :key="item.id">
        <router-link
          :to="{ name: item.route }"
          class="
            flex
            relative
            items-center
            space-x-3
            px-4
            py-3
            text-gray-500
            hover:bg-gray-100
            group
          "
          active-class="bg-gray-100 border-l-4 border-blue-600"
          exact-path
        >
          <span
            class="absolute left-0 h-full w-1 group-hover:bg-blue-600"
          ></span>
          <bhr-icon :name="item.icon"></bhr-icon>
          <span>{{ item.name }}</span>
        </router-link>
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  data() {
    return {
      navItems: [
        {
          name: "Dashboard",
          icon: "view-grid-add",
          route: "dashboard",
        },
        {
          name: "Tasks",
          icon: "document-search",
          route: "tasks",
        },
        {
          name: "Talents",
          icon: "briefcase",
          route: "talents",
        },
        {
          name: "Clients",
          icon: "user-group",
          route: "clients",
        },
        {
          name: "Recruiters",
          icon: "users",
          route: "recruiters",
        },
        {
          name: "Reports",
          icon: "chart-bar",
          route: "reports",
        },
        {
          name: "Calendar",
          icon: "calendar",
          route: "calendar",
        },
      ],
    };
  },
};
</script>