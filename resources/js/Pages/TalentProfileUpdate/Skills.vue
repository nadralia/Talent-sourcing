<template>
    <div>
        <TopHeaderBar
            page-name="Skills"
            page-number="5"
            @prevClicked="$router.push({ name: 'update-profile.education' })"
            @nextClicked="goNext"
            :disabled="
                !hasRecordsSavedOnProfile || !!hasUnsavedCachedData.length
            "
        />
        <!-- warning -->
        <t-alert
            variant="warning"
            :dismissible="false"
            :show="!!hasUnsavedCachedData.length"
            class="my-4"
        >
            <p>
                You have {{ hasUnsavedCachedData.length }} unsaved records in
                this section. Please add them to your profile, or delete them
                before proceeding.
            </p>
        </t-alert>
        <!-- primary skills -->
        <b-section>
            <template #heading>Primary Stack</template>
            <template #description>
                Add up to 4 stack/tools you’re proficient in and actively use
            </template>
            <template>
                <div class="mb-6 text-left" v-if="primary_skills.length < 4">
                    <b-button @click="showSkillModal(true)">
                        Add Primary Skill
                    </b-button>
                </div>
                <div v-if="loading">
                    <EducationLoadingAnimation />
                    <EducationLoadingAnimation />
                </div>
                <div v-if="primary_skills.length" class="space-y-6">
                    <div v-for="skill in primary_skills" :key="skill.id">
                        <SkillComponent
                            :all_skills="all_skills"
                            :skill_levels="skill_levels"
                            :skill="skill"
                            @deleteSkill="deleteSkillAsync"
                            @editSkill="editSkill"
                            :deletingSkill="deletingSkill"
                        />
                    </div>
                </div>
                <div v-else class="text-gray-400">* Required</div>
            </template>
        </b-section>

        <!-- secondary skills -->
        <b-section>
            <template #heading>Secondary Stacks</template>
            <template #description
                >Add up to 4 stack/tools that you’re also proficient in but
                don't use actively</template
            >
            <template>
                <div class="mb-6 text-left" v-if="secondary_skills.length < 4">
                    <b-button @click="showSkillModal()"
                        >Add Secondary Skill</b-button
                    >
                </div>
                <div v-if="loading">
                    <EducationLoadingAnimation />
                    <EducationLoadingAnimation />
                </div>

                <div v-if="secondary_skills.length" class="space-y-6">
                    <!-- secondary skills list -->
                    <div v-for="skill in secondary_skills" :key="skill.id">
                        <SkillComponent
                            :all_skills="all_skills"
                            :skill_levels="skill_levels"
                            :skill="skill"
                            @deleteSkill="deleteSkillAsync"
                            @editSkill="editSkill"
                            :deletingSkill="deletingSkill"
                        />
                    </div>
                </div>
            </template>
        </b-section>

        <!-- form modal -->
        <t-modal
            v-model="skillModal"
            :header="skillForm.id ? 'Update Skill' : 'Save Skill'"
        >
            <div class="grid grid-cols-4 gap-3">
                <t-input-group label="Select a Skill/Tool " class="col-span-4">
                    <t-rich-select
                        closeOnSelect
                        :options="all_skills"
                        v-model="skillForm.skill_id"
                        :variant="
                            skillForm.errors.errors.skill_id ? 'danger' : ''
                        "
                    />
                </t-input-group>

                <t-input-group
                    class="col-span-4 md:col-span-2"
                    label="Skill level"
                >
                    <t-rich-select
                        v-model="skillForm.skill_level_id"
                        :variant="
                            skillForm.errors.errors.skill_id
                                ? 'skill_level_id'
                                : ''
                        "
                        closeOnSelect
                        :options="skill_levels"
                    />
                </t-input-group>

                <t-input-group
                    class="col-span-4 md:col-span-2"
                    label="Using Since"
                >
                    <t-datepicker
                        v-model="skillForm.start_date"
                        :variant="
                            skillForm.errors.errors.start_date ? 'danger' : ''
                        "
                        date-format="Y-m-d"
                        user-format="M Y"
                        initial-view="year"
                    />
                </t-input-group>
            </div>
            <template #footer>
                <div class="flex justify-end">
                    <b-button @click="saveSkillAsync" :loading="skillForm.busy">
                        {{ skillForm.id ? "Update" : "Save" }}
                    </b-button>
                </div>
            </template>
        </t-modal>
    </div>
</template>

<script>
import BSection from "../../Shared/SectionForm.vue";
import BButton from "../../Shared/Button.vue";
import TextInput from "../../Shared/TextInput.vue";
import BTextarea from "../../Shared/Textarea";
import EducationLoadingAnimation from "../../Shared/EducationLoadingAnimation";
import SelectInput from "../../Shared/SelectInput.vue";
import Form from "vform";
import { PulseLoader } from "vue-spinner/dist/vue-spinner.min.js";
import appendDateMixin from "../../mixins/appendDate";
import SkillComponent from "./components/SkillComponent.vue";
import axios from "axios";
import TopHeaderBar from "./components/TopHeaderBar";
export default {
    components: {
        TopHeaderBar,
        PulseLoader,
        TextInput,
        BButton,
        BSection,
        BTextarea,
        EducationLoadingAnimation,
        SelectInput,
        SkillComponent,
    },

    mixins: [appendDateMixin],

    mounted() {
        this.getDataAsync();
        this.fetchSkillsLookup();
    },

    data() {
        return {
            primary_skills: [],
            secondary_skills: [],

            loading: false,
            deletingSkill: 0,
            skillModal: null,

            skillForm: new Form({
                id: null,
                is_primary: true,
                is_secondary: false,
                skill_id: null,
                skill: null,
                skill_level_id: null,
                start_date: null,
                key: null,
            }),

            all_skills: [],
            skill_levels: [],
        };
    },

    computed: {
        hasRecordsSavedOnProfile() {
            return this.primary_skills.filter((item) => !!item.id).length;
        },

        hasUnsavedCachedData() {
            return [
                ...this.primary_skills.filter((item) => !item.id),
                ...this.secondary_skills.filter((item) => !item.id),
            ];
        },
    },

    methods: {
        async getDataAsync() {
            this.loading = true;
            try {
                const { data } = await axios.get("/api/v1/talents/skills");

                this.primary_skills = data.data.filter(
                    (skl) => skl.is_primary == true
                );
                this.secondary_skills = data.data.filter(
                    (skl) => skl.is_secondary == true
                );
            } catch (error) {}

            this.loading = false;
        },

        async fetchSkillsLookup() {
            try {
                const skills = axios.get("/api/v1/lookup/skills");
                const skill_levels = axios.get("/api/v1/lookup/skill-levels");

                const [skillsRes, skillLevelRes] = await axios.all([
                    skills,
                    skill_levels,
                ]);

                this.all_skills = skillsRes.data.data.map((item) => ({
                    value: item.id,
                    text: item.name,
                }));

                this.skill_levels = skillLevelRes.data.data.map((item) => ({
                    value: item.id,
                    text: item.name,
                }));
            } catch (error) {}
        },

        async saveSkillAsync(type) {
            const method = this.skillForm.id ? "patch" : "post";

            try {
                this.skillForm.start_date = this.append_date(
                    this.skillForm.start_date
                );

                await this.skillForm[method](
                    `/api/v1/talents/skills/${
                        this.skillForm.id ? this.skillForm.id : ""
                    }`
                );

                this.skillForm.reset();

                this.$EventBus.$emit("update-completeness");

                this.skillModal = false;

                this.getDataAsync();
            } catch (error) {
                console.log(error.response);
                Flash({
                    type: "error",
                    title: error.response.data.message,
                });
            }
        },

        async deleteSkillAsync(skill) {
            if (!confirm("Confirm to delete this Skill")) return;
            this.deletingSkill = skill.id;
            try {
                await axios.delete(
                    `/api/v1/talents/skills/${skill.id || 0}?key=${
                        typeof skill.key == "number" ? skill.key.toString() : ""
                    }`
                );

                this.$EventBus.$emit("update-completeness");

                this.getDataAsync();
            } catch (error) {}
            this.deletingSkill = 0;
        },

        editSkill(skill) {
            this.skillForm.fill(skill);
            this.showSkillModal(skill.is_primary);
        },

        showSkillModal(is_primary) {
            if (is_primary) {
                this.skillForm.is_primary = true;
                this.skillForm.is_secondary = false;
            } else {
                this.skillForm.is_primary = false;
                this.skillForm.is_secondary = true;
            }

            this.skillModal = true;
        },

        goNext() {
            this.$EventBus.$emit("update-completeness");
            this.$router.push({ name: "update-profile.languages" });
        },
    },
};
</script>
