<template>
    <div>
        <TopHeaderBar
            page-name="Languages"
            page-number="6"
            @prevClicked="$router.push({ name: 'update-profile.skills' })"
            @nextClicked="goNext"
            :disabled="!englishForm.language_level_id"
        />
        <!-- English -->
        <b-section>
            <template #heading>English Proficiency</template>
            <template #description>How proficient are you in English?</template>
            <template>
                <div v-if="loading">
                    <EducationLoadingAnimation />
                    <EducationLoadingAnimation />
                </div>
                <div v-if="languages" class="space-y-6">
                    <div class="grid grid-cols-4 gap-4">
                        <div class="col-span-3">
                            <label>Proficiency</label>
                            <t-rich-select
                                v-model="englishForm.language_level_id"
                                closeOnSelect
                                :options="language_levels"
                                @input="
                                    englishForm.id
                                        ? updateProficiency(englishForm)
                                        : saveEnglishProficiency()
                                "
                            />
                        </div>
                        <div class="flex items-center">
                            <PulseLoader
                                v-if="englishForm.busy"
                                class="mt-3"
                                color="blue"
                            />
                        </div>
                    </div>
                </div>
            </template>
        </b-section>

        <!-- other languages -->
        <b-section>
            <template #heading>Other Languages</template>
            <template #description>Other languages you speak & write</template>
            <template>
                <div class="grid grid-cols-4 gap-4 mb-12 pb-6 border-b">
                    <t-input-group
                        label="Select language to add"
                        class="col-span-4 md:col-span-2"
                    >
                        <t-rich-select
                            v-model="languageForm.language_id"
                            closeOnSelect
                            :options="languages_list"
                            placeholder="Select language"
                        />
                    </t-input-group>
                    <t-input-group
                        label="Proficiency"
                        class="col-span-4 md:col-span-2"
                    >
                        <t-rich-select
                            v-model="languageForm.language_level_id"
                            closeOnSelect
                            :options="language_levels"
                            :disabled="!languageForm.language_id"
                            @change="addNewLanguage"
                            placeholder="Select your proficiency"
                        />
                        <div>
                            <PulseLoader
                                :loading="languageForm.busy"
                                class="mt-3"
                                color="blue"
                            />
                        </div>
                    </t-input-group>
                </div>

                <div v-if="loading">
                    <EducationLoadingAnimation />
                    <EducationLoadingAnimation />
                </div>

                <div v-if="languages" class="space-y-6">
                    <div
                        class="grid grid-cols-6 gap-4 border-b pb-4"
                        v-for="_language in languages.filter(
                            (l) => l.language_id !== 'EN'
                        )"
                        :key="_language.id"
                    >
                        <div class="col-span-3 md:col-span-2">
                            <label for="" class="text-xs text-gray-500"
                                >Language:</label
                            >
                            <p class="font-bold">{{ _language.language }}</p>
                        </div>
                        <t-input-group class="col-span-5 md:col-span-3">
                            <label for="" class="text-xs text-gray-500"
                                >Proficiency:</label
                            >
                            <t-rich-select
                                v-model="_language.language_level_id"
                                closeOnSelect
                                :options="language_levels"
                                @change="updateProficiency(_language)"
                            />
                        </t-input-group>
                        <div class="col-span-1 flex items-center">
                            <PulseLoader
                                v-if="deletingLanguage == _language.id"
                                class="mt-3"
                                color="blue"
                            />
                            <button v-else @click="deletelanguage(_language)">
                                <bhr-icon name="trash" class="text-red-500" />
                            </button>
                        </div>
                    </div>
                </div>
            </template>
        </b-section>
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

    mounted() {
        this.getDataAsync();
    },

    data() {
        return {
            languages: null,
            loading: false,
            deletingLanguage: null,

            language_levels: [
                { value: 1, text: "Basic" },
                { value: 2, text: "Conversational" },
                { value: 3, text: "Fluent" },
                { value: 4, text: "Native" },
            ],

            languageForm: new Form({
                language_id: null,
                language_level_id: null,
            }),

            englishForm: new Form({
                language_id: "EN",
                language_level_id: null,
            }),

            languages_list: [
                { value: "AA", text: "Afar" },
                { value: "AB", text: "Abkhazian" },
                { value: "AF", text: "Afrikaans" },
                { value: "AM", text: "Amharic" },
                { value: "AR", text: "Arabic" },
                { value: "AS", text: "Assamese" },
                { value: "AY", text: "Aymara" },
                { value: "AZ", text: "Azerbaijani" },
                { value: "BA", text: "Bashkir" },
                { value: "BE", text: "Byelorussian" },
                { value: "BG", text: "Bulgarian" },
                { value: "BH", text: "Bihari" },
                { value: "BI", text: "Bislama" },
                { value: "BN", text: "Bengali" },
                { value: "BO", text: "Tibetan" },
                { value: "BR", text: "Breton" },
                { value: "CA", text: "Catalan" },
                { value: "CO", text: "Corsican" },
                { value: "CS", text: "Czech" },
                { value: "CY", text: "Welsh" },
                { value: "DA", text: "Danish" },
                { value: "DE", text: "German" },
                { value: "DZ", text: "Bhutani" },
                { value: "EL", text: "Greek" },
                { value: "EN", text: "English" },
                { value: "EO", text: "Esperanto" },
                { value: "ES", text: "Spanish" },
                { value: "ET", text: "Estonian" },
                { value: "EU", text: "Basque" },
                { value: "FA", text: "Persian" },
                { value: "FI", text: "Finnish" },
                { value: "FJ", text: "Fiji" },
                { value: "FO", text: "Faeroese" },
                { value: "FR", text: "French" },
                { value: "FY", text: "Frisian" },
                { value: "GA", text: "Irish" },
                { value: "GD", text: "Gaelic (Scots Gaelic)" },
                { value: "GL", text: "Galician" },
                { value: "GN", text: "Guarani" },
                { value: "GU", text: "Gujarati" },
                { value: "HA", text: "Hausa" },
                { value: "HI", text: "Hindi" },
                { value: "HR", text: "Croatian" },
                { value: "HU", text: "Hungarian" },
                { value: "HY", text: "Armenian" },
                { value: "IA", text: "Interlingua" },
                { value: "IE", text: "Interlingue" },
                { value: "IK", text: "Inupiak" },
                { value: "IN", text: "Indonesian" },
                { value: "IS", text: "Icelandic" },
                { value: "IT", text: "Italian" },
                { value: "IW", text: "Hebrew" },
                { value: "JA", text: "Japanese" },
                { value: "JI", text: "Yiddish" },
                { value: "JW", text: "Javanese" },
                { value: "KA", text: "Georgian" },
                { value: "KK", text: "Kazakh" },
                { value: "KL", text: "Greenlandic" },
                { value: "KM", text: "Cambodian" },
                { value: "KN", text: "Kannada" },
                { value: "KO", text: "Korean" },
                { value: "KS", text: "Kashmiri" },
                { value: "KU", text: "Kurdish" },
                { value: "KY", text: "Kirghiz" },
                { value: "LA", text: "Latin" },
                { value: "LN", text: "Lingala" },
                { value: "LO", text: "Laothian" },
                { value: "LT", text: "Lithuanian" },
                { value: "LV", text: "Latvian" },
                { value: "MG", text: "Malagasy" },
                { value: "MI", text: "Maori" },
                { value: "MK", text: "Macedonian" },
                { value: "ML", text: "Malayalam" },
                { value: "MN", text: "Mongolian" },
                { value: "MO", text: "Moldavian" },
                { value: "MR", text: "Marathi" },
                { value: "MS", text: "Malay" },
                { value: "MT", text: "Maltese" },
                { value: "MY", text: "Burmese" },
                { value: "NA", text: "Nauru" },
                { value: "NE", text: "Nepali" },
                { value: "NL", text: "Dutch" },
                { value: "NO", text: "Norwegian" },
                { value: "OC", text: "Occitan" },
                { value: "OM", text: "Oromo" },
                { value: "OR", text: "Oriya" },
                { value: "PA", text: "Punjabi" },
                { value: "PL", text: "Polish" },
                { value: "PS", text: "Pashto" },
                { value: "PT", text: "Portuguese" },
                { value: "QU", text: "Quechua" },
                { value: "RM", text: "Rhaeto-Romance" },
                { value: "RN", text: "Kirundi" },
                { value: "RO", text: "Romanian" },
                { value: "RU", text: "Russian" },
                { value: "RW", text: "Kinyarwanda" },
                { value: "SA", text: "Sanskrit" },
                { value: "SD", text: "Sindhi" },
                { value: "SG", text: "Sangro" },
                { value: "SH", text: "Serbo-Croatian" },
                { value: "SI", text: "Singhalese" },
                { value: "SK", text: "Slovak" },
                { value: "SL", text: "Slovenian" },
                { value: "SM", text: "Samoan" },
                { value: "SN", text: "Shona" },
                { value: "SO", text: "Somali" },
                { value: "SQ", text: "Albanian" },
                { value: "SR", text: "Serbian" },
                { value: "SS", text: "Siswati" },
                { value: "ST", text: "Sesotho" },
                { value: "SU", text: "Sudanese" },
                { value: "SV", text: "Swedish" },
                { value: "SW", text: "Swahili" },
                { value: "TA", text: "Tamil" },
                { value: "TE", text: "Tegulu" },
                { value: "TG", text: "Tajik" },
                { value: "TH", text: "Thai" },
                { value: "TI", text: "Tigrinya" },
                { value: "TK", text: "Turkmen" },
                { value: "TL", text: "Tagalog" },
                { value: "TN", text: "Setswana" },
                { value: "TO", text: "Tonga" },
                { value: "TR", text: "Turkish" },
                { value: "TS", text: "Tsonga" },
                { value: "TT", text: "Tatar" },
                { value: "TW", text: "Twi" },
                { value: "UK", text: "Ukrainian" },
                { value: "UR", text: "Urdu" },
                { value: "UZ", text: "Uzbek" },
                { value: "VI", text: "Vietnamese" },
                { value: "VO", text: "Volapuk" },
                { value: "WO", text: "Wolof" },
                { value: "XH", text: "Xhosa" },
                { value: "YO", text: "Yoruba" },
                { value: "ZH", text: "Chinese" },
                { value: "ZU", text: "Zulu" },
            ],
        };
    },

    methods: {
        async getDataAsync() {
            this.loading = true;
            try {
                const { data } = await axios.get("/api/v1/talents/languages");

                this.languages = data.data;

                var english = this.languages.filter(
                    (l) => l.language == "English"
                );
                if (english[0]) {
                    this.englishForm.update(english[0]);
                }
            } catch (error) {}

            this.loading = false;
        },

        async addNewLanguage() {
            if (!this.languageForm.language_id) return;
            try {
                await this.languageForm.post("/api/v1/talents/languages");

                Flash({
                    type: "success",
                    title: "Language Added",
                });

                this.getDataAsync();
            } catch ({ response }) {
                Flash({
                    type: "error",
                    title: response.data.message,
                });
            }
            this.languageForm.reset();
        },

        async updateProficiency(language) {
            try {
                await axios.patch(
                    `/api/v1/talents/languages/${language.id}`,
                    language
                );
                Flash({
                    type: "success",
                    title: "English Proficiency Updated",
                });

                this.getDataAsync();
            } catch (error) {}
        },

        async saveEnglishProficiency() {
            try {
                await this.englishForm.post("/api/v1/talents/languages");

                this.$EventBus.$emit("update-completeness");

                Flash({
                    type: "success",
                    title: "English Proficiency Updated",
                });

                this.getDataAsync();
            } catch (error) {}
        },

        async deletelanguage(language) {
            if (!confirm("Confirm to delete this language")) return;
            this.deletingLanguage = language.id;
            try {
                await axios.delete(`/api/v1/talents/languages/${language.id}`);
                Flash({
                    type: "success",
                    title: "Language deleted",
                });
                this.getDataAsync();
            } catch (error) {}
            this.deletingLanguage = null;
        },

        goNext() {
            this.$EventBus.$emit("update-completeness");
            this.$router.push({ name: "update-profile.culturefit" });
        },
    },
};
</script>
