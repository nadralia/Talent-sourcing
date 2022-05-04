<template>
    <button
        :disabled="loading"
        @click="$emit('click')"
        class="px-4 py-2 bg-blue-600 text-blue-50 rounded hover:opacity-70 items-center inline-flex justify-center disabled:opacity-50"
        :class="`${bg} ${text} ${size} ${loading ? 'opacity-70' : ''}`"
        :type="type"
    >
        <PulseLoader v-if="loading" :loading="loading" color="white" />
        <slot v-else>Submit</slot>
    </button>
</template>

<script>
import Icons from "./Icons.vue";
import { PulseLoader } from "vue-spinner/dist/vue-spinner.min.js";
export default {
    components: { Icons, PulseLoader },
    props: {
        bg: {
            type: String,
            default: "bg-blue-600",
        },
        text: {
            type: String,
            default: "text-blue-50",
        },
        type: {
            type: String,
            default: "submit",
        },
        loading: Boolean,
        size: String,
    },
};
</script>
