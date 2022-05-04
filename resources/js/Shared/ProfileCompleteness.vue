<template>
    <div class="flex space-x-3 items-end">
        <span class="text-gray-200">Profile Completeness:</span>
        <pulse-loader v-if="updating" />
        <span v-else class="font-bold text-xl">{{ completeness }}%</span>
    </div>
</template>

<script>
export default {
    mounted() {
        this.updateCompletenessAsync();
    },

    created() {
        this.$EventBus.$on("update-completeness", () => {
            this.updateCompletenessAsync();
        });
    },

    data() {
        return {
            completeness: 0,
            updating: true,
        };
    },

    methods: {
        async updateCompletenessAsync() {
            this.updating = true;
            try {
                const { data } = await axios.get(
                    "/api/v1/talents/completeness"
                );
                // console.log(data);
                this.completeness = data.data;
            } catch (error) {
                console.log(error);
            }
            this.updating = false;
        },
    },
};
</script>
