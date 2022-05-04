<template>
    <div>
        <TopHeaderBar
            page-name="Resume"
            page-number="1"
            @nextClicked="$router.push({ name: 'update-profile.profile' })"
            :show-prev="false"
            :disabled="!resumes.length || uploading || parsingResume"
        />
        <!-- resume -->
        <b-section>
            <template #heading>Resume</template>
            <template #description>Upload / update your Resume</template>
            <template>
                <div class="space-y-7">
                    <t-alert :dismissible="false" show>
                        <div class="flex space-x-3 items-start">
                            <bhr-icon
                                name="information-circle"
                                class="h-8 w-8"
                            />
                            <p>
                                We will attempt to parse your resume and extract
                                the necessary information. You'll have the
                                option to review and add the parsed data to your
                                profile.
                            </p>
                        </div>
                    </t-alert>

                    <div class="flex items-center space-x-3">
                        <div class="flex-1" v-if="uploading">
                            <p class="mb-3">
                                Uploading... ({{ uploadProgress }}%)
                            </p>

                            <!-- progress bar -->
                            <progress-bar :progress="uploadProgress" />
                        </div>

                        <bhr-button
                            v-else
                            class="space-x-3"
                            @click="$refs.resumeFile.click()"
                            :disabled="parsingResume"
                        >
                            <bhr-icon name="cloud-upload" />
                            <span class="whitespace-nowrap">Upload Resume</span>
                        </bhr-button>

                        <!-- hidden file input -->
                        <input
                            type="file"
                            ref="resumeFile"
                            class="hidden"
                            accept=".pdf"
                            @change="handleResumeUploadAsync"
                        />
                    </div>

                    <!--  resumes loader -->
                    <div v-if="loading || parsingResume" class="flex">
                        <pulse-loader color="blue"></pulse-loader>
                        <span v-if="parsingResume && !uploading"
                            >Parsing resume...</span
                        >
                    </div>

                    <div v-if="resumes.length" class="space-y-5">
                        <div
                            class="flex items-center space-x-3"
                            v-for="resume in resumes"
                            :key="resume.id"
                        >
                            <button @click="deleteResumeAsync(resume)">
                                <pulse-loader
                                    size="5px"
                                    color="blue"
                                    v-if="deletingResume == resume.id"
                                />
                                <bhr-icon
                                    name="trash"
                                    class="text-red-400"
                                    v-else
                                />
                            </button>
                            <button
                                target="_blank"
                                href="#"
                                class="flex border text-sm rounded-lg font-medium text-blue-600 space-x-2 items-center bg-gray-100 px-4 py-2 hover:text-blue-800"
                                @click="loadResumeAsync(resume)"
                            >
                                <bhr-icon name="paper-clip" />
                                <span> {{ resume.name }}</span>
                            </button>
                        </div>
                    </div>
                </div>
            </template>
            <template #footer> </template>
        </b-section>
    </div>
</template>

<script>
import BSection from "../../Shared/SectionForm.vue";
import BButton from "../../Shared/Button.vue";
import TextInput from "../../Shared/TextInput.vue";
import BTextarea from "../../Shared/Textarea";
import TopHeaderBar from "./components/TopHeaderBar";
export default {
    components: {
        TopHeaderBar,
        TextInput,
        BButton,
        BSection,
        BTextarea,
    },

    mounted() {
        this.getDataAsync();
    },

    data() {
        return {
            resumes: [],
            file: null,
            deletingResume: null,
            parsingResume: null,
            uploadProgress: 0,
            downloadProgress: 0,
            loading: false,
        };
    },

    computed: {
        uploading() {
            return !(this.uploadProgress == 0 || this.uploadProgress == 100);
        },
    },

    methods: {
        async getDataAsync() {
            this.loading = true;
            try {
                const { data } = await axios.get("/api/v1/talents/resumes");

                this.resumes = data.data;
            } catch (error) {}
            this.loading = false;
        },

        async loadResumeAsync(resume) {
            try {
                const { data } = await axios.get(
                    `/api/v1/talents/resumes/${resume.id}?file=true`,
                    {
                        method: "GET",
                        responseType: "blob",
                    }
                );
                //Create a Blob from the PDF Stream
                const file = new Blob([data], {
                    type: "application/pdf",
                });
                //Build a URL from the file
                const fileURL = URL.createObjectURL(file);
                //Open the URL on new Window
                window.open(fileURL);
            } catch (error) {}
        },

        async handleResumeUploadAsync(e) {
            this.file = this.$refs.resumeFile.files[0];

            let formData = new FormData();

            formData.append("file", this.file);

            try {
                this.parsingResume = true;

                const { data } = await axios.post(
                    "/api/v1/talents/resumes",
                    formData,
                    {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        },
                        onUploadProgress: (progressEvent) => {
                            this.uploadProgress = Math.round(
                                (progressEvent.loaded * 100) /
                                    progressEvent.total
                            );
                        },
                    }
                );
                this.parsingResume = false;
                this.getDataAsync();
            } catch (error) {}
        },

        async deleteResumeAsync(resume) {
            if (confirm("Confirm to delete this resume")) {
                this.deletingResume = resume.id;
                try {
                    await axios.delete(`/api/v1/talents/resumes/${resume.id}`);
                    this.getDataAsync();
                } catch (error) {}
                this.deletingResume = null;
            }
        },
    },
};
</script>
