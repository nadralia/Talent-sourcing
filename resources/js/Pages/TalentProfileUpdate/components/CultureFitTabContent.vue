<template>
    <div class="py-8" v-show="category.id == selection.id">
        <div class="flex mb-6" v-if="loading">
            <CultureFItValueLoadingAnimation />
        </div>
        <div v-else>
            <div class="mb-6 space-y-3 flex justify-between items-start">
                <div>
                    <p>
                        Select
                        <span class="font-bold">{{
                            category.max_choices
                        }}</span>
                        words/phrases that best describe your
                        <span class="font-bold">{{ category.name }}</span>
                    </p>
                    <p class="font-semibold text-gray-600">
                        ({{ selected_fits_scoped_to_this_category.length }}
                        selected)
                    </p>
                </div>

                <bhr-button
                    variant="secondary"
                    @click="updateculturefit"
                    :loading="updatingculturefit"
                    bg="bg-green-700"
                    :disabled="!required_selections_selected"
                >
                    Update Selection
                </bhr-button>
            </div>

            <div class="flex flex-wrap">
                <button
                    v-for="fit in cf_questions"
                    :key="fit.id"
                    class="px-4 py-2 rounded-lg mr-3 mb-3 disabled:cursor-not-allowed disabled:text-gray-500 disabled:bg-gray-50"
                    :class="
                        selectedFits.includes(fit.id)
                            ? 'bg-green-200'
                            : 'bg-gray-100 hover:bg-gray-50'
                    "
                    @click="selectCultureFit(fit)"
                    :disabled="is_disabled(fit)"
                >
                    <div class="flex items-center space-x-3">
                        <div>
                            <PulseLoader
                                size="5px"
                                v-if="addingFit && addingFit.id == fit.id"
                            />
                            <bhr-icon
                                v-else-if="selectedFits.includes(fit.id)"
                                name="check-circle"
                            />
                        </div>
                        <div>
                            {{ fit.name }}
                        </div>
                    </div>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { PulseLoader } from "vue-spinner/dist/vue-spinner.min.js";
import CultureFItValueLoadingAnimation from "../../../Shared/CultureFItValueLoadingAnimation.vue";
export default {
    props: {
        category: Object,
        selection: Object,
    },

    components: {
        PulseLoader,
        CultureFItValueLoadingAnimation,
    },

    mounted() {
        this.getData();
    },

    data() {
        return {
            updatingculturefit: false,
            loading: false,
            cf_questions: [],
            originalSelectedFits: [],
            selectedFits: [],
            addingFit: null,
        };
    },

    watch: {
        category(old, newval) {
            if (old !== newval) {
                this.getData();
            }
        },
    },

    computed: {
        selected_fits_scoped_to_this_category() {
            return this.cf_questions.filter((item) =>
                this.selectedFits.includes(item.id)
            );
        },

        required_selections_selected() {
            return (
                this.selected_fits_scoped_to_this_category.length ==
                this.category.max_choices
            );
        },

        selections_have_changed() {
            return (
                JSON.stringify(this.selectedFits) ==
                JSON.stringify(this.originalSelectedFits)
            );
        },
    },

    methods: {
        async getData() {
            this.loading = true;
            try {
                const culturefitvalues = axios.get(
                    `/api/v1/lookup/culture-fit-categories/${this.category.id}/culture-fit`
                );
                const selectedFits = axios.get("/api/v1/talents/culture-fit");

                const resp = await axios.all([culturefitvalues, selectedFits]);

                this.cf_questions = resp[0].data.data;
                this.selectedFits = resp[1].data.data;
                this.originalSelectedFits = resp[1].data.data;

                this.emitEvent();
            } catch (error) {}

            this.loading = false;
        },

        selectCultureFit(fit) {
            if (this.selectedFits.includes(fit.id)) {
                this.selectedFits = this.selectedFits.filter(
                    (id) => id !== fit.id
                );
            } else {
                this.selectedFits.push(fit.id);
            }
        },

        async updateculturefit() {
            this.updatingculturefit = true;

            try {
                const { data } = await axios.patch(
                    "/api/v1/talents/culture-fit",
                    { data: this.selectedFits }
                );

                this.selectedFits = data.data;

                this.emitEvent();

                Flash({
                    type: "success",
                    title: "Culture Fit Updated",
                });
            } catch (error) {
                console.log(error);
                Flash({
                    type: "error",
                    title: "An error occured",
                });
            }
            this.updatingculturefit = null;
        },

        is_disabled(fit) {
            if (
                this.selected_fits_scoped_to_this_category.length <
                this.category.max_choices
            ) {
                return false;
            }
            if (this.selectedFits.includes(fit.id)) {
                return false;
            }

            return true;
        },

        emitEvent() {
            this.$emit("cfUpdated", {
                category: this.category,
                current_selections:
                    this.selected_fits_scoped_to_this_category.length,
            });

            if (this.required_selections_selected) {
                this.$EventBus.$emit("update-completeness");
            }
        },
    },
};
</script>
