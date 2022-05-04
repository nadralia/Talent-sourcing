<template>
    <div class="mb-12">
        <div class="md:grid md:grid-cols-5 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-semibold leading-6 text-gray-900">
                        <slot name="heading"></slot>
                    </h3>
                    <p class="mt-1 text-sm text-gray-600">
                        <slot name="description"></slot>
                    </p>
                </div>
            </div>
            <div class="md:mt-0 md:col-span-4">
                <div>
                    <div
                        class="shadow-sm mt-3 sm:mt-0 border-1 border-gray-200 rounded-lg"
                    >
                        <div class="px-6 py-8 space-y-6">
                            <slot></slot>
                        </div>
                        <div
                            class="px-4 py-3 bg-gray-50 text-right sm:px-6"
                            v-if="$slots.footer"
                        >
                            <slot name="footer"></slot>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
