<script setup>
    const props = defineProps({
        class: String
    })
</script>

<template>
    <div class="mt-20 lg:flex lg:items-center lg:justify-between max-w-7xl mx-auto " :class="props.class">
        <h2 class="text-2xl font-bold text-gray-900 sm:text-4xl capitalize">
            <slot name="header" />
        </h2>
        <div v-if="$slots.action" class="mt-8 flex lg:mt-0 lg:flex-shrink-0 space-x-2">
            <slot name="action" />
        </div>
    </div>

    <div class="max-w-prose mb-10">
      <p class="text-gray-700">
        <slot name="desc" />
      </p>
    </div>
</template>
