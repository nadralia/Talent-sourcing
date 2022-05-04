<template>
    <div class="md:flex justify-between items-center mb-12 px-4">
        <div class="mb-3">
            <button
                v-if="showPrev"
                class="font-semibold text-blue-500 flex items-center space-x-1 mb-2"
                @click="$emit('prevClicked')"
            >
                <bhr-icon name="arrow-left" /> <span>Previous</span>
            </button>
            <div class="flex flex-wrap space-x-3 items-baseline">
                <p class="text-5xl font-bold text-gray-800 leading-none">
                    {{ pageName }}
                </p>
                <p class="text-gray-400 font-bold">{{ pageNumber }} / 7</p>
            </div>
        </div>
        <div>
            <bhr-button
                @click="$emit('nextClicked')"
                v-if="showNext"
                :loading="loading"
                :disabled="disabled"
            >
                <p class="text-xl">{{ isFinish ? "Finish" : "Next ->" }}</p>
            </bhr-button>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        pageName: String,
        nextPage: String,
        showNext: {
            type: Boolean,
            default: true,
        },
        showPrev: {
            type: Boolean,
            default: true,
        },
        loading: Boolean,
        disabled: Boolean,
        isFinish: Boolean,
        pageNumber: Number | String,
    },
};
</script>
