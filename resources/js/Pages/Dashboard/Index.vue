<template>
  <base-layout>
    <div class="py-4 grid grid-cols-4 gap-6">
      <!-- main section -->
      <div class="col-span-3">
        <!-- metric cards -->
        <div class="flex-1 grid grid-cols-4 gap-4">
          <metric-card
            name="Vacancies"
            count="100"
            icon="briefcase"
            bg-color="bg-pink-100"
            text-color="text-pink-800"
          >
          </metric-card>
          <metric-card
            name="Applicants"
            count="2K"
            icon="user-group"
            bg-color="bg-red-100"
            text-color="text-red-800"
          >
          </metric-card>
          <metric-card
            name="Ongoing"
            count="150"
            icon="switch-horizontal"
            bg-color="bg-yellow-100"
            text-color="text-yellow-800"
          >
          </metric-card>
          <metric-card
            name="Hired"
            count="50"
            icon="user-add"
            bg-color="bg-green-100"
            text-color="text-green-800"
          >
          </metric-card>
        </div>

        <div class="grid grid-cols-3 gap-4 mt-4">
          <div class="col-span-2">
            <!-- you need to hire -->
            <bhr-card class="bg-white">
              <template #header>
                <p class="text-sm font-semibold">You need to hire</p>
                <a href="#" class="text-xs text-blue-600 underline">See all</a>
              </template>
              <job-task-card
                job-description="Senior Frontend Developer"
                :experience="4"
                :candidates="2"
                :languages="[
                  'React',
                  'Vue',
                  'NodeJs',
                  'PHP',
                  'Laravel',
                  'Css',
                  'Angular',
                  'HTML',
                  'Python',
                ]"
              />
              <job-task-card
                job-description="Senior Backend Developer"
                :experience="4"
                :candidates="2"
                :languages="[
                  'React',
                  'Vue',
                  'NodeJs',
                  'PHP',
                  'Laravel',
                  'Css',
                  'Angular',
                  'HTML',
                  'Python',
                ]"
              />
              <job-task-card
                job-description="Senior Backend Developer"
                :experience="4"
                :candidates="2"
                :languages="[
                  'React',
                  'Vue',
                  'NodeJs',
                  'PHP',
                  'Laravel',
                  'Css',
                  'Angular',
                  'HTML',
                  'Python',
                ]"
              />
            </bhr-card>
          </div>
          <div class="col-span-1">
            <!-- you need to vet -->
            <bhr-card class="bg-white">
              <template #header>
                <p class="text-sm font-semibold">You need to Vet</p>
                <a href="#" class="text-xs text-blue-600 underline">See all</a>
              </template>

              <div>
                <span class="text-xs block">Frontend Developer</span>
                <div class="space-x-3 text-gray-500 -mt-2">
                  <span class="text-tiny leading-3">10 Candidates</span>
                  <span class="text-tiny leading-3">10 Candidates</span>
                </div>
              </div>
              <div>
                <span class="text-xs block">Frontend Developer</span>
                <div class="space-x-3 text-gray-500 -mt-2">
                  <span class="text-tiny leading-3">10 Candidates</span>
                  <span class="text-tiny leading-3">10 Candidates</span>
                </div>
              </div>
              <div>
                <span class="text-xs block">Frontend Developer</span>
                <div class="space-x-3 text-gray-500 -mt-2">
                  <span class="text-tiny leading-3">10 Candidates</span>
                  <span class="text-tiny leading-3">10 Candidates</span>
                </div>
              </div>
              <div>
                <span class="text-xs block">Frontend Developer</span>
                <div class="space-x-3 text-gray-500 -mt-2">
                  <span class="text-tiny leading-3">10 Candidates</span>
                  <span class="text-tiny leading-3">10 Candidates</span>
                </div>
              </div>
              <div>
                <span class="text-xs block">Frontend Developer</span>
                <div class="space-x-3 text-gray-500 -mt-2">
                  <span class="text-tiny leading-3">10 Candidates</span>
                  <span class="text-tiny leading-3">10 Candidates</span>
                </div>
              </div>
            </bhr-card>
          </div>
        </div>
      </div>

      <!-- right -->
      <div class="col-span-1">
        <div class="rounded-lg overflow-hidden shadow-sm text-white">
          <div class="p-2 px-3 bg-slate-700">Recent Activity</div>
          <div class="p-3 bg-slate-800 space-y-1">
            <p class="text-tiny text-gray-300">
              {{ dayjs().format("hh.mm A, ddd d MMM YYYY") }}
            </p>
            <p class="capitalize">You posted a new job</p>
            <p class="text-xs text-gray-300">
              Kindly check the requirements and terms of work and make sure
              everything is right.
            </p>
            <bhr-button class="mt-3">See All Activity</bhr-button>
          </div>
        </div>
      </div>
    </div>
  </base-layout>
</template>


<script>
import BaseLayout from "../../Layout/Index.vue";
import MetricCard from "../../Shared/MetricCard.vue";
import JobTaskCard from "../../Shared/JobTaskCard.vue";
export default {
  components: {
    BaseLayout,
    MetricCard,
    JobTaskCard,
  },
};
</script>