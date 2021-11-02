<template>
    <div class="bg-primary text-white rounded p-10 text-md w-full">
        <div class="h3" v-if="title" v-html="title"></div>
        <div v-if="text" v-html="text"></div>
    </div>
</template>

<script setup lang="ts">
defineProps({
    title: {
        type: String,
        default: null,
    },
    text: {
        type: String,
        default: null,
    },
    link: {
        type: String,
        default: null,
    },
    target: {
        type: String,
        default: null,
    },
});
</script>
