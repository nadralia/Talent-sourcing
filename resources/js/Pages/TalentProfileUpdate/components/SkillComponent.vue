<template>
    <div class="grid grid-cols-4 gap-4 border-b pb-2">
        <div class="col-span-2 md:col-span-1">
            <p class="font-semibold text-lg">{{ skill.skill }}</p>
            <p class="text-xs text-gray-500">{{ skill_duration }}</p>
            <span class="text-xs text-gray-500"> </span>
        </div>
        <div class="col-span-2 md:col-span-1">
            <p class="text-xs text-gray-500">Level:</p>
            <p class="font-semibold">{{ skill.skill_level }}</p>
        </div>
        <div class="col-span-2 md:col-span-1">
            <p class="text-xs text-gray-500">Using since:</p>
            <p class="font-semibold">
                {{ $dayjs(skill.start_date).format("MMM YYYY") }}
            </p>
        </div>
        <div class="col-span-2 md:col-span-1">
            <PulseLoader
                v-if="deletingSkill === skill.id"
                class="mt-3"
                color="blue"
            />
            <div v-else class="flex items-center space-x-3">
                <button @click="$emit('editSkill', skill)">
                    <bhr-icon name="pencil" class="text-blue-500" />
                </button>

                <button @click="$emit('deleteSkill', skill)">
                    <bhr-icon name="trash" class="text-red-500" />
                </button>
                <div
                    v-if="!skill.id"
                    class="bg-yellow-100 text-yellow-900 px-3 py-1 rounded leading-none"
                >
                    <span class="text-tiny"
                        >Parsed from resume. Edit to save</span
                    >
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { PulseLoader } from "vue-spinner/dist/vue-spinner.min.js";
export default {
    components: {
        PulseLoader,
    },
    props: {
        skill: Object,
        skill_levels: Array,
        all_skills: Array,
        deletingSkill: Number,
    },

    computed: {
        skill_duration() {
            return this.skill.years_experience > 1
                ? `${this.skill.years_experience} years exp.`
                : `<= 1 year exp.`;
        },
    },
};
</script>
