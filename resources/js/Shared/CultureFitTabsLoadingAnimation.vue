<template>
    <div>
        <div class="flex space-x-3 border-b pb-3">
            <VueSkeletonLoader
                type="rect"
                :width="100"
                :height="40"
                animation="wave"
            />
            <VueSkeletonLoader
                type="rect"
                :width="100"
                :height="40"
                animation="wave"
            />
            <VueSkeletonLoader
                type="rect"
                :width="100"
                :height="40"
                animation="wave"
            />
        </div>
        <div class="mt-7 space-y-5">
            <CultureFItValueLoadingAnimation />
        </div>
    </div>
</template>

<script>
import VueSkeletonLoader from "skeleton-loader-vue";
import CultureFItValueLoadingAnimation from "./CultureFItValueLoadingAnimation";
export default {
    components: {
        VueSkeletonLoader,
        CultureFItValueLoadingAnimation,
    },
};
</script>
