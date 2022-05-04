<template>
    <div>
        <TopHeaderBar
            page-name="Profile"
            page-number="2"
            @prevClicked="$router.push({ name: 'update-profile.resume' })"
            @nextClicked="saveProfileAsync"
            :loading="user.busy"
        />
        <b-section v-if="loading">
            <template>
                <EducationLoadingAnimation />
                <EducationLoadingAnimation />
            </template>
        </b-section>
        <form v-else-if="user.id" @submit.prevent="saveProfileAsync">
            <!-- biodata -->
            <b-section>
                <template #heading>Your Personal Information</template>
                <template #description
                    >Your Name and Contact Information</template
                >
                <template>
                    <div class="grid grid-cols-4 gap-4">
                        <t-input-group class="col-span-4 md:col-span-2">
                            <label
                                >First Name
                                <span class="text-red-500">*</span></label
                            >
                            <t-input
                                v-model="user.first_name"
                                :variant="
                                    user.errors.errors.first_name
                                        ? 'danger'
                                        : ''
                                "
                            />
                        </t-input-group>

                        <t-input-group class="col-span-4 md:col-span-2">
                            <label
                                >Last Name
                                <span class="text-red-500">*</span></label
                            >
                            <t-input
                                v-model="user.last_name"
                                :variant="
                                    user.errors.errors.last_name ? 'danger' : ''
                                "
                            />
                        </t-input-group>

                        <t-input-group
                            class="col-span-4 md:col-span-2"
                            label="Email"
                        >
                            <t-input
                                v-model="user.email"
                                type="email"
                                disabled
                                readonly
                            />
                        </t-input-group>
                        <t-input-group class="col-span-4 md:col-span-2">
                            <label
                                >Phone
                                <span class="text-red-500">*</span></label
                            >
                            <t-input
                                v-model="user.phone"
                                :variant="
                                    user.errors.errors.phone ? 'danger' : ''
                                "
                                type="number"
                                pattern="[1-9]"
                                required
                            />
                        </t-input-group>
                        <t-input-group class="col-span-4 md:col-span-2">
                            <label
                                >Gender
                                <span class="text-red-500">*</span></label
                            >
                            <t-rich-select
                                v-model="user.gender_id"
                                :variant="
                                    user.errors.errors.gender_id ? 'danger' : ''
                                "
                                closeOnSelect
                                hideSearchBox
                                :options="genders"
                                required
                            />
                        </t-input-group>
                        <t-input-group
                            label="Birthday"
                            class="col-span-4 md:col-span-2"
                        >
                            <t-datepicker
                                user-format="M d"
                                date-format="m-d"
                                v-model="user.birthday"
                                :variant="
                                    user.errors.errors.birthday ? 'danger' : ''
                                "
                                initial-view="year"
                                clearable
                                placeholder="birthday"
                                autocomplete="off"
                            />
                            <div class="opacity-0">
                                <t-datepicker />
                            </div>
                        </t-input-group>
                    </div>
                </template>
            </b-section>

            <!-- Password -->
            <b-section>
                <template #heading>Password & Security</template>
                <template #description
                    >Update your default password if you haven't
                    already</template
                >
                <template>
                    <div class="grid grid-cols-4 gap-4">
                        <t-input-group class="col-span-4 md:col-span-2">
                            <label
                                >New Password
                                <span class="text-red-500">*</span></label
                            >
                            <t-input
                                v-model="user.password"
                                :variant="
                                    user.errors.errors.password ? 'danger' : ''
                                "
                                type="password"
                            />
                        </t-input-group>
                        <t-input-group class="col-span-4 md:col-span-2">
                            <label
                                >Repeat Password
                                <span class="text-red-500">*</span></label
                            >
                            <t-input
                                v-model="user.password_confirmation"
                                :variant="
                                    user.errors.errors.password_confirmation
                                        ? 'danger'
                                        : ''
                                "
                                type="password"
                            />
                        </t-input-group>
                    </div>
                </template>
            </b-section>

            <!-- professional information -->
            <b-section>
                <template #heading>Your Professional Information</template>
                <template>
                    <div class="grid grid-cols-4 gap-4">
                        <div class="col-span-4 md:col-span-2">
                            <label
                                >Title / Profession
                                <span class="text-red-500">*</span></label
                            >
                            <t-rich-select
                                v-model="user.title_id"
                                :variant="
                                    user.errors.errors.title_id ? 'danger' : ''
                                "
                                closeOnSelect
                                :options="titles"
                                hideSearchBox
                                required
                            />
                        </div>
                        <t-input-group
                            class="col-span-4 md:col-span-2"
                            description="How long have you been in this role?"
                        >
                            <label
                                >Title Start Date
                                <span class="text-red-500">*</span></label
                            >
                            <t-datepicker
                                date-format="Y-m-d"
                                user-format="M Y"
                                v-model="user.title_start_date"
                                :variant="
                                    user.errors.errors.title_start_date
                                        ? 'danger'
                                        : ''
                                "
                                initial-view="year"
                                clearable
                            />
                        </t-input-group>
                        <t-input-group
                            label="Current Job Status"
                            class="col-span-4 md:col-span-2"
                        >
                            <t-rich-select
                                v-model="user.job_status_id"
                                :variant="
                                    user.errors.errors.job_status_id
                                        ? 'danger'
                                        : ''
                                "
                                closeOnSelect
                                :options="job_statuses"
                            />
                        </t-input-group>
                        <t-input-group
                            label="Notice Period"
                            class="col-span-4 md:col-span-2"
                        >
                            <t-rich-select
                                v-model="user.notice_period_id"
                                :variant="
                                    user.errors.errors.notice_period_id
                                        ? 'danger'
                                        : ''
                                "
                                closeOnSelect
                                :options="notice_periods"
                            />
                        </t-input-group>
                        <t-input-group
                            label="Job Preference"
                            class="col-span-2"
                        >
                            <t-rich-select
                                v-model="user.remote_type_id"
                                :variant="
                                    user.errors.errors.remote_type_id
                                        ? 'danger'
                                        : ''
                                "
                                closeOnSelect
                                :options="remote_types"
                            />
                        </t-input-group>
                    </div>
                </template>
            </b-section>

            <!-- address -->
            <b-section>
                <template #heading>Your Address & Location</template>
                <template>
                    <div class="grid grid-cols-4 gap-4">
                        <t-input-group class="col-span-4" label="Address">
                            <t-textarea
                                v-model="user.address"
                                :variant="
                                    user.errors.errors.address ? 'danger' : ''
                                "
                            />
                        </t-input-group>
                        <t-input-group class="col-span-3">
                            <label
                                >Nationality
                                <span class="text-red-500">*</span></label
                            >
                            <t-rich-select
                                v-model="user.nationality"
                                :variant="
                                    user.errors.errors.nationality
                                        ? 'danger'
                                        : ''
                                "
                                closeOnSelect
                                :options="countries"
                                required
                            />
                        </t-input-group>
                        <div class="col-span-4 pt-3 pb-1 border-b">
                            <span>Your current locaion</span>
                        </div>
                        <t-input-group class="col-span-2">
                            <label
                                >Country
                                <span class="text-red-500">*</span></label
                            >
                            <t-rich-select
                                v-model="user.country_id"
                                :variant="
                                    user.errors.errors.country_id
                                        ? 'danger'
                                        : ''
                                "
                                closeOnSelect
                                :options="countries"
                                required
                            />
                        </t-input-group>
                        <t-input-group class="col-span-2">
                            <label
                                >State/City/Province
                                <span class="text-red-500">*</span></label
                            >
                            <t-rich-select
                                v-model="user.state_id"
                                :variant="
                                    user.errors.errors.state_id ? 'danger' : ''
                                "
                                :placeholder="
                                    loadingStatesNcurrency
                                        ? 'Loading states, please wait...'
                                        : `Select a city or state in ${user.country_id}`
                                "
                                closeOnSelect
                                :options="states"
                                :disabled="loadingStatesNcurrency"
                                required
                            />
                        </t-input-group>
                    </div>
                </template>
            </b-section>

            <!-- compensation -->
            <b-section>
                <template #heading>Payment Expectation</template>
                <template #description>Your annual salary expectation</template>
                <template>
                    <div class="grid grid-cols-6 gap-4">
                        <t-input-group class="col-span-4 md:col-span-2">
                            <label
                                >Currency
                                <span class="text-red-500">*</span></label
                            >
                            <t-rich-select
                                v-model="user.salary_currency_id"
                                :variant="
                                    user.errors.errors.salary_currency_id
                                        ? 'danger'
                                        : ''
                                "
                                closeOnSelect
                                :options="currencies"
                            />
                        </t-input-group>
                        <t-input-group class="col-span-4 md:col-span-2">
                            <label
                                >Minimum Aunnal Salary
                                <span class="text-red-500">*</span></label
                            >
                            <t-input
                                v-model="user.min_salary"
                                :variant="
                                    user.errors.errors.min_salary
                                        ? 'danger'
                                        : ''
                                "
                                type="number"
                                pattern="[1-9]"
                                min="1"
                                required
                            />
                        </t-input-group>
                        <t-input-group class="col-span-4 md:col-span-2">
                            <label
                                >Maximum Aunnal Salary
                                <span class="text-red-500">*</span></label
                            >
                            <t-input
                                v-model="user.max_salary"
                                :variant="
                                    user.errors.errors.max_salary
                                        ? 'danger'
                                        : ''
                                "
                                type="number"
                                pattern="[1-9]"
                            />
                        </t-input-group>
                    </div>
                </template>
            </b-section>

            <!-- links -->
            <b-section>
                <template #heading>Important Links</template>
                <template #description
                    >Your Professional & Social Links</template
                >
                <template>
                    <div class="grid grid-cols-4 gap-4">
                        <t-input-group class="col-span-4 md:col-span-2">
                            <label
                                >LinkedIn
                                <span class="text-red-500">*</span></label
                            >
                            <t-input
                                v-model="user.linkedin"
                                :variant="
                                    user.errors.errors.linkedin ? 'danger' : ''
                                "
                            />
                        </t-input-group>
                        <t-input-group
                            label="Github"
                            class="col-span-4 md:col-span-2"
                        >
                            <t-input
                                v-model="user.github"
                                :variant="
                                    user.errors.errors.github ? 'danger' : ''
                                "
                            />
                        </t-input-group>
                        <t-input-group
                            label="Twitter"
                            class="col-span-4 md:col-span-2"
                        >
                            <t-input
                                v-model="user.twitter"
                                :variant="
                                    user.errors.errors.twitter ? 'danger' : ''
                                "
                            />
                        </t-input-group>
                        <t-input-group
                            label="Website"
                            class="col-span-4 md:col-span-2"
                        >
                            <t-input
                                v-model="user.website"
                                :variant="
                                    user.errors.errors.website ? 'danger' : ''
                                "
                            />
                        </t-input-group>
                    </div>
                </template>
            </b-section>

            <div class="text-right">
                <b-button :loading="user.busy">Update Profile</b-button>
            </div>
        </form>
    </div>
</template>

<script>
import BSection from "../../Shared/SectionForm.vue";
import BButton from "../../Shared/Button.vue";
import TextInput from "../../Shared/TextInput.vue";
import BTextarea from "../../Shared/Textarea";
import EducationLoadingAnimation from "../../Shared/EducationLoadingAnimation";
import Form from "vform";
import TopHeaderBar from "./components/TopHeaderBar";
import appendDate from "../../mixins/appendDate";
export default {
    components: {
        TopHeaderBar,
        TextInput,
        BButton,
        BSection,
        BTextarea,
        EducationLoadingAnimation,
    },

    mixins: [appendDate],

    mounted() {
        this.getProfileDataAsync();
        this.getLookupDataAsync();
    },

    data() {
        return {
            loading: false,
            loadingStatesNcurrency: false,
            user: new Form({
                id: null,
                first_name: null,
                last_name: null,
                email: null,
                birthday: null,
                password: null,
                avatar: null,
                phone: null,
                address: null,
                title_id: null,
                linkedin: null,
                github: null,
                twitter: null,
                website: null,
                nationality: null,
                country_id: null,
                gender_id: null,
                notice_period_id: null,
                min_salary: null,
                max_salary: null,
                salary_currency_id: null,
                state_id: null,
                remote_type_id: null,
                job_status_id: null,
                title_start_date: null,
            }),

            titles: [],
            countries: [],
            job_statuses: [],
            notice_periods: [],
            remote_types: [],
            currencies: [],
            genders: [],
            states: [],
        };
    },

    watch: {
        "user.country_id": function (newCountry, oldVal) {
            if (!newCountry) return;

            if (newCountry == oldVal) return;

            let isFirstPageLoad = false;

            if (!oldVal) {
                isFirstPageLoad = true;
            }

            this.fetchStatesAndCurrencyForCountryAsync(
                newCountry,
                isFirstPageLoad
            );
        },
    },

    methods: {
        async getProfileDataAsync() {
            this.loading = true;
            try {
                const { data } = await axios.get("/api/update-profile");
                this.user.fill(data.data);
            } catch (error) {
                console.log(error);
            }

            this.loading = false;
        },

        async fetchStatesAndCurrencyForCountryAsync(
            country_id,
            isFirstPageLoad
        ) {
            this.loadingStatesNcurrency = true;
            try {
                const paths = [
                    axios.get(`/api/v1/lookup/countries/${country_id}/states`),
                    axios.get(
                        `/api/v1/lookup/countries/${country_id}/currencies`
                    ),
                ];

                this.states = [];

                if (!isFirstPageLoad) {
                    this.user.state_id = null;
                }

                const res = await axios.all(paths);

                this.states = res[0].data.data.map((item) => ({
                    value: item.id,
                    text: item.name,
                }));

                if (res[1].data.data) {
                    this.user.salary_currency_id = res[1].data.data[0].id;
                }
            } catch (error) {}
            this.loadingStatesNcurrency = false;
        },

        async getLookupDataAsync() {
            this.loading = true;
            try {
                const lookups = [
                    "titles",
                    "countries",
                    "remote_types",
                    "notice_periods",
                    "job_statuses",
                    "currencies",
                    "genders",
                ];

                const endpoints = lookups.map((lookup) => {
                    return axios.get(
                        `/api/v1/lookup/${lookup.replace("_", "-")}`
                    );
                });

                const responses = await axios.all(endpoints);

                this.titles = responses[0].data.data.map((item) => ({
                    value: item.id,
                    text: item.name,
                }));

                this.countries = responses[1].data.data.map((item) => ({
                    value: item.id,
                    text: item.name,
                }));

                this.remote_types = responses[2].data.data.map((item) => ({
                    value: item.id,
                    text: item.name,
                }));

                this.notice_periods = responses[3].data.data.map((item) => ({
                    value: item.id,
                    text: item.name,
                }));

                this.job_statuses = responses[4].data.data.map((item) => ({
                    value: item.id,
                    text: item.name,
                }));

                this.currencies = responses[5].data.data.map((item) => ({
                    value: item.id,
                    text: `${item.id} (${item.name})`,
                    country: item.name,
                }));

                this.genders = responses[6].data.data.map((item) => ({
                    value: item.id,
                    text: item.name,
                }));
            } catch (error) {
                console.log(error);
            }
            this.loading = false;
        },

        async saveProfileAsync() {
            this.user.title_start_date = this.append_date(
                this.user.title_start_date
            );
            try {
                this.user.avatar = null;
                await this.user.patch(`/api/v1/talents/${this.user.id}`);
                Flash({
                    type: "success",
                    title: "Profile Updated",
                });
                this.$EventBus.$emit("update-completeness");

                this.$router.push({ name: "update-profile.experience" });
            } catch (error) {
                console.log(error);
                Flash({
                    type: "error",
                    title: error.response.data.message,
                });
            }
        },
    },
};
</script>
