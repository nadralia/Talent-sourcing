<template>
    <div>
        <TopHeaderBar
            page-number="4"
            page-name="Education"
            @prevClicked="$router.push({ name: 'update-profile.experience' })"
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
            <template #heading>Education</template>
            <template #description
                >Details of your educational background</template
            >

            <template>
                <div class="mb-6 text-left">
                    <b-button @click="showEducationModal = true"
                        >Add Education</b-button
                    >
                </div>
                <div v-if="loading">
                    <EducationLoadingAnimation />
                    <EducationLoadingAnimation />
                </div>
                <div v-if="educations.length">
                    <div
                        v-for="education in educations"
                        :key="education.id"
                        class="flex mb-2 space-x-3"
                    >
                        <!-- left side icon bar -->
                        <div class="flex flex-col items-center">
                            <div
                                class="h-10 w-10 bg-gray-200 rounded-full flex items-center justify-center"
                            >
                                <bhr-icon
                                    name="academic-cap"
                                    class="h-5 w-5 text-gray-600"
                                />
                            </div>
                            <div
                                class="border-1 border-gray-200 flex-grow"
                            ></div>
                        </div>

                        <!--Education Details -->
                        <div class="space-y-1 mb-10">
                            <!-- Parsed from resume -->
                            <div
                                class="flex items-center space-x-3 p-1 px-3 bg-yellow-100 text-yellow-900 rounded-lg mb-3"
                                v-if="!education.id"
                            >
                                <bhr-icon name="information-circle" />
                                <p class="font-medium text-xs">
                                    Parsed from your resume. Edit to add to your
                                    profile --->
                                </p>
                            </div>

                            <p class="text-gray-700 text-sm">
                                {{ education.degree }}
                            </p>
                            <p class="font-bold">{{ education.title }}</p>
                            <p>{{ education.institution }}</p>
                            <div class="text-gray-500 text-xs">
                                {{ education.start_date }} to
                                {{ education.end_date || "present" }}
                            </div>
                        </div>

                        <!-- action buttons -->
                        <div class="md:w-16 flex-grow flex justify-end">
                            <PulseLoader
                                v-if="deletingEducation === education.id"
                                class="mt-3"
                                color="blue"
                            />
                            <div
                                v-else
                                class="flex flex-col md:flex-row items-start md:space-x-3"
                            >
                                <button @click="editEducationAsync(education)">
                                    <bhr-icon
                                        name="pencil"
                                        class="text-blue-500 mb-4"
                                    />
                                </button>
                                <button
                                    @click="deleteEducationAsync(education)"
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

        <!-- education modal -->
        <t-modal
            :header="form.id ? 'Update Education' : 'Add Education'"
            v-model="showEducationModal"
        >
            <form
                class="grid grid-cols-4 gap-4"
                @submit.prevent="saveEducationAsync"
            >
                <t-input-group label="Degree *" class="col-span-4">
                    <t-rich-select
                        :variant="form.errors.errors.degree_id ? 'danger' : ''"
                        v-model="form.degree_id"
                        closeOnSelect
                        :options="degrees"
                    />
                </t-input-group>
                <t-input-group label="Title *" class="col-span-4">
                    <t-input
                        :variant="form.errors.errors.title ? 'danger' : ''"
                        v-model="form.title"
                    />
                </t-input-group>
                <t-input-group label="Institution *" class="col-span-4">
                    <t-input
                        :variant="
                            form.errors.errors.institution ? 'danger' : ''
                        "
                        v-model="form.institution"
                    />
                </t-input-group>
                <t-input-group
                    label="Start Date *"
                    class="col-span-4 md:col-span-2"
                >
                    <t-datepicker
                        :variant="form.errors.errors.start_date ? 'danger' : ''"
                        v-model="form.start_date"
                        date-format="Y-m-d"
                        user-format="Y M"
                        initial-view="year"
                    />
                </t-input-group>
                <t-input-group
                    label="End Date"
                    class="col-span-4 md:col-span-2"
                    feedback="Present? Leave empty."
                >
                    <t-datepicker
                        :variant="form.errors.errors.end_date ? 'danger' : ''"
                        v-model="form.end_date"
                        date-format="Y-m-d"
                        user-format="Y M"
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
            educations: [],
            loading: false,
            saving: false,
            deletingEducation: 0,
            showEducationModal: false,

            form: new Form({
                id: null,
                degree_id: null,
                title: null,
                institution: null,
                start_date: null,
                end_date: null,
                key: null,
            }),

            degrees: [],
        };
    },

    computed: {
        hasRecordsSavedOnProfile() {
            return this.educations.filter((item) => !!item.id).length;
        },

        hasUnsavedCachedData() {
            return this.educations.filter((item) => !item.id);
        },
    },

    methods: {
        async getDataAsync() {
            this.loading = true;
            try {
                const { data } = await axios.get("/api/v1/talents/educations");

                this.educations = data.data;
            } catch (error) {}

            this.loading = false;
        },

        async saveEducationAsync() {
            try {
                this.form.start_date = this.append_date(this.form.start_date);
                this.form.end_date = this.append_date(this.form.end_date);

                const method = this.form.id ? "patch" : "post";

                const path = this.form.id
                    ? `/api/v1/talents/educations/${this.form.id}`
                    : `/api/v1/talents/educations`;

                await this.form[method](path);

                this.$EventBus.$emit("update-completeness");

                this.form.reset();
                this.showEducationModal = false;
                Flash({
                    type: "success",
                    title: "Education record saved",
                });
                this.getDataAsync();
            } catch (error) {}
        },

        async deleteEducationAsync(education) {
            if (!confirm("Delete this Education record?")) return;

            this.deletingEducation = education.id;
            try {
                await axios.delete(
                    `/api/v1/talents/educations/${education.id || 0}?key=${
                        typeof education.key == "number"
                            ? education.key.toString()
                            : ""
                    }`
                );

                this.getDataAsync();

                this.$EventBus.$emit("update-completeness");

                Flash({
                    type: "success",
                    title: "Education removed",
                });
            } catch (error) {}
            this.deletingEducation = 0;
        },

        editEducationAsync(education) {
            this.form.fill(education);
            this.showEducationModal = true;
        },

        async getLookupDataAsync() {
            try {
                const lookups = ["degrees"];

                const endpoints = lookups.map((lookup) => {
                    return axios.get(`/api/v1/lookup/${lookup}`);
                });

                const responses = await axios.all(endpoints);

                this.degrees = responses[0].data.data.map((item) => ({
                    value: item.id,
                    text: item.name,
                }));
            } catch (error) {
                console.log(error);
            }
        },

        goNext() {
            this.$EventBus.$emit("update-completeness");
            this.$router.push({ name: "update-profile.skills" });
        },
    },
};
</script>
