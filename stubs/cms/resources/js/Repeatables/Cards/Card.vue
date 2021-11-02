<template>
    <div class="col-span-12 p-6 bg-white shadow md:col-span-6 lg:col-span-4">
        <div class="pb-2 font-bold">{{ repeatable.title }}</div>
        {{ repeatable.text }}
    </div>
</template>

<script setup lang="ts">
defineProps({
    repeatable: {
        type: Object,
    },
});
</script>
