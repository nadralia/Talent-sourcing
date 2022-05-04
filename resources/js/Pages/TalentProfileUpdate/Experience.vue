<template>
    <div>
        <TopHeaderBar
            page-name="Experience"
            page-number="3"
            @prevClicked="$router.push({ name: 'update-profile.profile' })"
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
        <b-section>
            <template #heading>Experience</template>
            <template #description>Your professional experience</template>

            <template>
                <div class="mb-6 text-left">
                    <b-button @click="showExperienceModal = true"
                        >Add Experience</b-button
                    >
                </div>
                <div v-if="loading">
                    <EducationLoadingAnimation />
                    <EducationLoadingAnimation />
                </div>
                <div v-if="experiences.length">
                    <div
                        v-for="experience in experiences"
                        :key="experience.id"
                        class="flex mb-2 space-x-3"
                    >
                        <!-- left icon bar -->
                        <div class="flex flex-col items-center">
                            <div
                                class="h-10 w-10 bg-gray-200 rounded-full flex items-center justify-center"
                            >
                                <bhr-icon
                                    name="briefcase"
                                    class="h-4 w-4 text-gray-600"
                                />
                            </div>
                            <div
                                class="border-1 border-gray-200 flex-grow"
                            ></div>
                        </div>

                        <!-- experience details -->
                        <div class="flex-1 space-y-1 mb-10">
                            <!-- Parsed from resume notice -->
                            <div
                                class="flex items-center space-x-3 p-1 px-3 bg-yellow-100 text-yellow-900 rounded-lg mb-3"
                                v-if="!experience.id"
                            >
                                <bhr-icon name="information-circle" />
                                <p class="font-medium text-xs">
                                    Parsed from your resume. Edit to add to your
                                    profile --->
                                </p>
                            </div>

                            <p class="text-gray-700 font-bold">
                                <span>{{ experience.seniority }}</span>
                                <span>{{ experience.title }}</span>
                            </p>
                            <div class="">{{ experience.company_name }}</div>
                            <div class="text-sm">
                                <span v-if="experience.state"
                                    >{{ experience.state }},</span
                                >
                                <span v-if="experience.country">{{
                                    experience.country
                                }}</span>
                            </div>
                            <pre
                                class="text-sm text-gray-600 py-2 whitespace-pre-wrap"
                                >{{ experience.description }}</pre
                            >
                            <div
                                class="text-gray-500 text-xs space-x-3"
                                v-if="experience.start_date"
                            >
                                <bhr-icon name="calendar" />
                                <span class="font-semibold"
                                    >{{
                                        $dayjs(experience.start_date).format(
                                            "YYYY MMM"
                                        )
                                    }}
                                    to
                                    {{
                                        experience.end_date
                                            ? $dayjs(
                                                  experience.end_date
                                              ).format("YYYY MMM")
                                            : "present"
                                    }}</span
                                >
                            </div>
                        </div>

                        <!-- action buttons -->
                        <div class="md:w-16 flex justify-end">
                            <PulseLoader
                                v-if="deletingExperience === experience.id"
                                class="mt-3"
                                color="blue"
                            />
                            <div
                                v-else
                                class="flex flex-col md:flex-row items-start md:space-x-3"
                            >
                                <button
                                    @click="editExperienceAsync(experience)"
                                >
                                    <bhr-icon
                                        name="pencil"
                                        class="text-blue-500 mb-4"
                                    />
                                </button>
                                <button
                                    @click="deleteExperienceAsync(experience)"
                                >
                                    <bhr-icon
                                        name="trash"
                                        class="text-red-500"
                                    />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </b-section>

        <!-- experience modal -->
        <t-modal
            :header="form.id ? 'Update Experience' : 'Add Experience'"
            v-model="showExperienceModal"
        >
            <form
                class="grid grid-cols-4 gap-4"
                @submit.prevent="saveExperienceAsync"
            >
                <t-input-group label="Title *" class="col-span-4">
                    <t-rich-select
                        :variant="form.errors.errors.title_id ? 'danger' : ''"
                        v-model="form.title_id"
                        closeOnSelect
                        :options="titles"
                        required
                    />
                </t-input-group>
                <t-input-group label="Seniority *" class="col-span-3">
                    <t-rich-select
                        :variant="
                            form.errors.errors.seniority_id ? 'danger' : ''
                        "
                        v-model="form.seniority_id"
                        closeOnSelect
                        :options="seniorities"
                        required
                    />
                </t-input-group>
                <t-input-group label="Company Name *" class="col-span-4">
                    <t-input
                        :variant="
                            form.errors.errors.company_name ? 'danger' : ''
                        "
                        v-model="form.company_name"
                        required
                    />
                </t-input-group>
                <t-input-group label="Description *" class="col-span-4">
                    <t-textarea
                        :variant="
                            form.errors.errors.description ? 'danger' : ''
                        "
                        v-model="form.description"
                        rows="5"
                        required
                    />
                </t-input-group>
                <t-input-group label="Industry/Sector *" class="col-span-3">
                    <t-rich-select
                        :variant="
                            form.errors.errors.industry_id ? 'danger' : ''
                        "
                        v-model="form.industry_id"
                        closeOnSelect
                        :options="industries"
                        required
                    />
                </t-input-group>
                <t-input-group
                    label="Country *"
                    class="col-span-4 md:col-span-2"
                >
                    <t-rich-select
                        :variant="form.errors.errors.country_id ? 'danger' : ''"
                        v-model="form.country_id"
                        closeOnSelect
                        :options="countries"
                        required
                    />
                </t-input-group>
                <t-input-group label="State *" class="col-span-4 md:col-span-2">
                    <t-rich-select
                        :variant="form.errors.errors.state_id ? 'danger' : ''"
                        v-model="form.state_id"
                        closeOnSelect
                        :options="states"
                        required
                    />
                </t-input-group>
                <t-input-group
                    label="Start Date *"
                    class="col-span-4 md:col-span-2"
                >
                    <t-datepicker
                        :variant="form.errors.errors.start_date ? 'danger' : ''"
                        v-model="form.start_date"
                        user-forma="M Y"
                        date-format="Y-m"
                        initial-view="year"
                        required
                    />
                </t-input-group>
                <t-input-group
                    label="End Date"
                    class="col-span-4 md:col-span-2"
                    feedback="Present? Leave empty"
                >
                    <t-datepicker
                        :variant="form.errors.errors.end_date ? 'danger' : ''"
                        v-model="form.end_date"
                        user-forma="M Y"
                        date-format="Y-m"
                        initial-view="year"
                    />
                </t-input-group>

                <div class="flex justify-end col-span-4">
                    <b-button type="submit" :loading="form.busy">
                        {{ form.id ? "Update" : "Save" }}
                    </b-button>
                </div>
            </form>
        </t-modal>
    </div>
</template>

<script>
import BSection from "../../Shared/SectionForm.vue";
import BButton from "../../Shared/Button.vue";
import TextInput from "../../Shared/TextInput.vue";
import BTextarea from "../../Shared/Textarea";
import EducationLoadingAnimation from "../../Shared/EducationLoadingAnimation";
import Form from "vform";
import { PulseLoader } from "vue-spinner/dist/vue-spinner.min.js";
import appendDate from "../../mixins/appendDate";
import TopHeaderBar from "./components/TopHeaderBar";
export default {
    components: {
        TopHeaderBar,
        TextInput,
        BButton,
        BSection,
        BTextarea,
        EducationLoadingAnimation,
        PulseLoader,
    },

    mixins: [appendDate],

    mounted() {
        this.getDataAsync();
        this.getLookupDataAsync();
    },

    data() {
        return {
            experiences: [],
            loading: false,
            saving: false,
            deletingExperience: 0,
            showExperienceModal: false,

            form: new Form({
                id: null,
                company_name: null,
                description: null,
                seniority_id: null,
                title_id: null,
                industry_id: null,
                state_id: null,
                country_id: null,
                start_date: null,
                end_date: null,
                enabled: null,
                key: null,
            }),

            titles: [],
            industries: [],
            countries: [],
            seniorities: [],
            states: [],
        };
    },

    computed: {
        hasRecordsSavedOnProfile() {
            return this.experiences.filter((item) => !!item.id).length;
        },

        hasUnsavedCachedData() {
            return this.experiences.filter((item) => !item.id);
        },
    },

    watch: {
        "form.country_id": function (old, incoming) {
            if (old !== incoming) {
                this.fetchStatesAsync();
            }
        },
    },
    methods: {
        async getDataAsync() {
            this.loading = true;
            try {
                const { data } = await axios.get("/api/v1/talents/experiences");

                this.experiences = data.data;
            } catch (error) {
                console.log(error);
            }

            this.loading = false;
        },

        async saveExperienceAsync() {
            try {
                this.form.start_date = this.append_date(this.form.start_date);
                this.form.end_date = this.append_date(this.form.end_date);

                const method = this.form.id ? "patch" : "post";
                const path = this.form.id
                    ? `/api/v1/talents/experiences/${this.form.id}`
                    : `/api/v1/talents/experiences`;

                await this.form[method](path);

                this.form.reset();

                this.$EventBus.$emit("update-completeness");

                this.showExperienceModal = false;
                Flash({
                    type: "success",
                    title: "Experience record saved",
                });
                this.getDataAsync();
            } catch (error) {}
        },

        async deleteExperienceAsync(experience) {
            if (!confirm("Delete this Experience record?")) return;
            this.deletingExperience = experience.id;
            try {
                await axios.delete(
                    `/api/v1/talents/experiences/${experience.id || 0}?key=${
                        typeof experience.key === "number"
                            ? experience.key.toString()
                            : "" // the key is a zero based index
                    }`
                );
                this.getDataAsync();

                this.$EventBus.$emit("update-completeness");

                Flash({
                    type: "success",
                    title: "Experience removed",
                });
            } catch (error) {}
            this.deletingExperience = 0;
        },

        editExperienceAsync(experience) {
            this.form.fill(experience);
            this.showExperienceModal = true;
        },

        async getLookupDataAsync() {
            try {
                const lookups = [
                    "titles",
                    "industries",
                    "countries",
                    "seniorities",
                ];

                const endpoints = lookups.map((lookup) => {
                    return axios.get(`/api/v1/lookup/${lookup}`);
                });

                const responses = await axios.all(endpoints);

                this.titles = responses[0].data.data.map((item) => ({
                    value: item.id,
                    text: item.name,
                }));

                this.industries = responses[1].data.data.map((item) => ({
                    value: item.id,
                    text: item.name,
                }));

                this.countries = responses[2].data.data.map((item) => ({
                    value: item.id,
                    text: item.name,
                }));

                this.seniorities = responses[3].data.data.map((item) => ({
                    value: item.id,
                    text: item.name,
                }));
            } catch (error) {
                console.log(error);
            }
        },

        async fetchStatesAsync(e) {
            try {
                const res = await axios.get(
                    `/api/v1/lookup/countries/${this.form.country_id}/states`
                );

                this.states = res.data.data.map((item) => ({
                    value: item.id,
                    text: item.name,
                }));
            } catch (error) {}
        },

        goNext() {
            this.$EventBus.$emit("update-completeness");
            this.$router.push({ name: "update-profile.education" });
        },
    },
};
</script>
