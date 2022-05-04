<template>
    <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">
        <div
            class="bg-blue-600 h-2 text-xs font-medium text-blue-100 text-center p-0.5 leading-none"
            :style="`width: ${progress}%`"
        ></div>
    </div>
</template>

<script>
export default {
    props: {
        progress: Number | String,
        showPercentage: Boolean,
    },
};
</script>
