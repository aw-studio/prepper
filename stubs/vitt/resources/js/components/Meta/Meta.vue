<template>
    <Head :title="title">
        <slot />
    </Head>
</template>

<script setup lang="ts">
import { defineProps, PropType } from 'vue';
import { Head } from '@inertiajs/inertia-vue3';

defineProps({
    title: {
        type: String as PropType<string>,
        default: 'My App',
    },
});
</script>
