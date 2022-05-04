<template>
  <div class="rounded-lg shadow-sm">
    <div
      class="px-3 pt-3 pb-0 flex items-center justify-between"
      v-if="$slots.header"
    >
      <slot name="header"></slot>
    </div>
    <div class="p-3 space-y-3" v-if="$slots.default">
      <slot></slot>
    </div>
  </div>
</template>