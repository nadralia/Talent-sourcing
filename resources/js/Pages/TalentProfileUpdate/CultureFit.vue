<template>
    <div>
        <TopHeaderBar
            page-name="Culture Fit"
            page-number="7"
            @prevClicked="$router.push({ name: 'update-profile.languages' })"
            @nextClicked="goNext"
            is-finish
            :loading="finishing"
            :disabled="!all_selections_satisfied"
        />

        <div v-if="loading">
            <CultureFitLoadingAnimation />
        </div>

        <div v-else>
            <div class="border-b border-gray-200">
                <ul class="flex -mb-px">
                    <li
                        class="mr-2"
                        v-for="category in cf_categories"
                        :key="category.id"
                        @click="selectCategory(category)"
                    >
                        <a
                            :href="`#category_${category.id}`"
                            class="inline-block py-4 px-4 text-sm font-medium text-center rounded-t-lg border-b-2 border-transparent space-x-3"
                            :class="
                                selected_category.id == category.id
                                    ? 'text-blue-500 hover:text-blue-600 border-blue-300 font-bold'
                                    : 'text-gray-500 hover:text-gray-600 hover:border-gray-300'
                            "
                        >
                            <span :id="category.id">{{ category.name }}</span>
                            <span
                                class="text-xs px-2 rounded-full"
                                :class="
                                    category.current_selections ==
                                    category.max_choices
                                        ? 'bg-green-100 text-green-800'
                                        : 'bg-red-100 text-red-800'
                                "
                                >{{ category.current_selections }}/{{
                                    category.max_choices
                                }}</span
                            >
                        </a>
                    </li>
                </ul>
            </div>
            <div class="px-4">
                <TabContent
                    v-for="cat in cf_categories"
                    :key="cat.id"
                    :category="cat"
                    :selection="selected_category"
                    @cfUpdated="handleCultureFitSelectEvent"
                />
            </div>
        </div>
    </div>
</template>

<script>
import CultureFitLoadingAnimation from "../../Shared/CultureFitTabsLoadingAnimation";
import { PulseLoader } from "vue-spinner/dist/vue-spinner.min.js";
import TabContent from "./components/CultureFitTabContent";
import axios from "axios";
import TopHeaderBar from "./components/TopHeaderBar";
export default {
    components: {
        TopHeaderBar,
        PulseLoader,
        TabContent,
        CultureFitLoadingAnimation,
    },

    mounted() {
        this.getDataAsync();
    },

    data() {
        return {
            finishing: false,
            loading: true,
            cf_categories: [],
            selected_category: null,
        };
    },

    computed: {
        all_selections_satisfied() {
            return (
                this.cf_categories.filter((item) => {
                    return item.max_choices == item.current_selections;
                }).length == 3
            );
        },
    },

    methods: {
        async getDataAsync() {
            this.loading = true;
            try {
                const cultureFit = axios.get(
                    "/api/v1/lookup/culture-fit-categories"
                );

                const [cultrefitResponse] = await axios.all([cultureFit]);

                this.cf_categories = cultrefitResponse.data.data;

                this.selectCategory(this.cf_categories[0]);
            } catch (error) {}
            this.loading = false;
        },

        // async loadCategoryQuestionsAsyc() {
        //     const paths = [];
        // },

        selectCategory(cat) {
            this.$EventBus.$emit("update-completeness");
            this.selected_category = cat;
        },

        async goNext() {
            this.finishing = true;

            try {
                await axios.delete("/api/update-profile/finish");

                this.$router.push({ name: "update-profile.finish" });
            } catch (error) {}

            this.finishing = false;
        },

        handleCultureFitSelectEvent({ category, current_selections }) {
            this.cf_categories = this.cf_categories.map((item) => {
                if (item.id == category.id) {
                    item.current_selections = current_selections;
                }
                return item;
            });
        },
    },
};
</script>
