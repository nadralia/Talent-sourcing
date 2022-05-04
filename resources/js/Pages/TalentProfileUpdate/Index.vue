<template>
    <div class="relative bg-blue-50 min-h-screen">
        <alert />
        <!-- top bar -->
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="p-4 flex justify-between items-center">
                <!-- logo -->
                <application-mark class="w-40" />

                <div class="flex items-center space-x-3" v-if="user">
                    <div class="text-right">
                        <p class="font-semibold">{{ user.name }}</p>
                        <p class="text-sm text-gray-600 tracking-wide">
                            {{ user.email }}
                        </p>
                    </div>
                    <div
                        class="hidden sm:flex items-center justify-center bg-green-100 text-green-900 shadow-sm border-green-50 border rounded-full h-12 w-12 font-bold"
                    >
                        <p>{{ user.initials }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!--  -->
        <div class="bg-blue-900 text-white">
            <div
                class="max-w-7xl flex-col-reverse mx-auto sm:px-6 lg:px-8 p-4 flex md:flex-row justify-between md:items-center"
            >
                <div>
                    <p class="font-bold text-2xl md:text-3xl">
                        Talent Profile Update
                    </p>
                    <p class="tracking-widest">Account / Profile Update</p>
                    <br />
                    <profile-completeness />
                </div>
                <div class="">
                    <button
                        @click="logoutAsync"
                        class="text-white mb-3 w-auto font-bold hover:text-red-100 p-2 px-4 rounded bg-blue-800 hover:bg-blue-700 flex items-center space-x-2 disabled:opacity-50"
                        :disabled="loggingOut"
                    >
                        <bhr-icon name="lock" />
                        <span>Logout</span>
                        <pulse-loader :loading="loggingOut" size="5px" />
                    </button>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-3">
            <div class="bg-white py-6 md:px-6 rounded-lg">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
import Alert from "../../Shared/Alert.vue";
import ApplicationMark from "../../Shared/ApplicationMark.vue";
import ProfileCompleteness from "../../Shared/ProfileCompleteness.vue";

export default {
    components: {
        ApplicationMark,
        Alert,
        ProfileCompleteness,
    },

    mounted() {
        this.getUserFromLocalStorage();
    },

    data() {
        return {
            loggingOut: false,
            user: null,
            navigation: [
                {
                    route: "update-profile.resume",
                    name: "Resume",
                },
                {
                    route: "update-profile.profile",
                    name: "Profile",
                },
                {
                    route: "update-profile.experience",
                    name: "Experience",
                },
                {
                    route: "update-profile.education",
                    name: "Education",
                },
                {
                    route: "update-profile.skills",
                    name: "Skills",
                },
                {
                    route: "update-profile.languages",
                    name: "Languages",
                },
                {
                    route: "update-profile.culturefit",
                    name: "Culture Fit",
                },
            ],
        };
    },

    methods: {
        getUserFromLocalStorage() {
            const user = localStorage.getItem("_talent");

            if (user) {
                const { name, avatar, email, initials } = JSON.parse(user);
                this.user = { name, avatar, email, initials };
            }
        },

        async logoutAsync() {
            this.loggingOut = true;
            try {
                const res = await axios.delete("/api/update-profile/auth");
                localStorage.removeItem("_talents");
                this.$router.push({ path: "/update-profile/login" });
            } catch (error) {}
            this.loggingOut = false;
        },
    },
};
</script>
