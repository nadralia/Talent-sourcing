<template>
    <div class="relative min-h-screen sm:flex bg-white">
        <alert />
        <div
            class="hidden md:flex flex-1 bg-top bg-cover bg-no-repeat bg-blue-50"
            style="background-image: url('/assets/images/login-art.png')"
        ></div>
        <div class="flex-1 py-20 px-6 sm:px-20">
            <div class="max-w-xl mx-auto">
                <application-mark class="" />

                <div class="mt-20">
                    <p class="font-bold text-3xl">Log In To Borderless</p>

                    <form
                        class="mt-12 space-y-12"
                        @submit.prevent="handleLoginAsync"
                    >
                        <t-input-group
                            label="Email Address"
                            :description="
                                form.errors.errors.email
                                    ? form.errors.errors.email[0]
                                    : null
                            "
                        >
                            <t-input
                                :variant="
                                    form.errors.errors.email ? 'danger' : ''
                                "
                                v-model="form.email"
                                type="email"
                                autofocus
                            />
                        </t-input-group>
                        <t-input-group
                            label="Password"
                            :description="
                                form.errors.errors.email
                                    ? form.errors.errors.email[0]
                                    : null
                            "
                        >
                            <t-input
                                :variant="
                                    form.errors.errors.password ? 'danger' : ''
                                "
                                v-model="form.password"
                                type="password"
                            />
                        </t-input-group>
                        <div class="flex justify-center mt-12">
                            <bhr-button :loading="form.busy" class="text-xl"
                                >Log in</bhr-button
                            >
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Form from "vform";
import ApplicationMark from "../../Shared/ApplicationMark.vue";
import Alert from "../../Shared/Alert.vue";
import TextInput from "../../Shared/TextInput.vue";
export default {
    components: {
        ApplicationMark,
        Alert,
        TextInput,
    },

    data() {
        return {
            form: new Form({
                email: "",
                password: "",
            }),
        };
    },

    methods: {
        async handleLoginAsync() {
            try {
                const { data } = await this.form.post(`/api/v1/talents/auth`);

                localStorage._talent = JSON.stringify(data.data);

                Flash({
                    type: "success",
                    title: "Authentication successful",
                });

                // Send the user to the route they inteded to go before authentication
                // route.intended should be set in localhost for this to happen
                const to =
                    localStorage.getItem("route.intended") ||
                    "update-profile.resume";

                this.$router.push({ name: to });
            } catch ({ response }) {
                if (response.data.message) {
                    Flash({
                        type: "error",
                        title: "Unable to authenticate",
                        message: response.data.message,
                    });
                }
            }
        },
    },
};
</script>
