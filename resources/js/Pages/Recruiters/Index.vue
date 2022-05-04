<template>
  <base-layout>
    <!-- top bar -->
    <div class="flex justify-between py-4 border-b">
      <div class="">
        <p class="font-bold">Recruiters</p>
      </div>
    </div>

    <!-- content area -->
    <div class="py-4 grid grid-cols-4 gap-4">
      <!-- recruiter card -->
      <recruiter-card
        v-for="recruiter in recruiters"
        :key="recruiter.id"
        class="bg-white rounded-lg shadow-sm p-4"
        :recruiter="recruiter"
      >
      </recruiter-card>
    </div>
  </base-layout>
</template>

<script>
import RecruiterCard from "./components/RecruiterCard.vue";
import BaseLayout from "../../Layout/Index.vue";
export default {
  components: {
    BaseLayout,
    RecruiterCard,
  },

  mounted() {
    console.log(this.$route);
  },

  data() {
    return {
      recruiters: [
        {
          id: 1,
          initials: "JL",
          name: "Jennifer Lewis",
          description: "Works as a Recruiter II",
          email: "jenniferlewis@borderless.com",
          tasks: 100,
          hired: 50,
        },
        {
          id: 2,
          initials: "JL",
          name: "Jennifer Lewis",
          description: "Works as a Recruiter II",
          email: "jenniferlewis@borderless.com",
          tasks: 100,
          hired: 50,
        },
        {
          id: 3,
          initials: "JL",
          name: "Jennifer Lewis",
          description: "Works as a Recruiter II",
          email: "jenniferlewis@borderless.com",
          tasks: 100,
          hired: 50,
        },
        {
          id: 4,
          initials: "JL",
          name: "Jennifer Lewis",
          description: "Works as a Recruiter II",
          email: "jenniferlewis@borderless.com",
          tasks: 100,
          hired: 50,
        },
        {
          id: 5,
          initials: "JL",
          name: "Jennifer Lewis",
          description: "Works as a Recruiter II",
          email: "jenniferlewis@borderless.com",
          tasks: 100,
          hired: 50,
        },
        {
          id: 6,
          initials: "JL",
          name: "Jennifer Lewis",
          description: "Works as a Recruiter II",
          email: "jenniferlewis@borderless.com",
          tasks: 100,
          hired: 50,
        },
        {
          id: 7,
          initials: "JL",
          name: "Jennifer Lewis",
          description: "Works as a Recruiter II",
          email: "jenniferlewis@borderless.com",
          tasks: 100,
          hired: 50,
        },
        {
          id: 8,
          initials: "JL",
          name: "Jennifer Lewis",
          description: "Works as a Recruiter II",
          email: "jenniferlewis@borderless.com",
          tasks: 100,
          hired: 50,
        },
      ],
    };
  },
};
</script>