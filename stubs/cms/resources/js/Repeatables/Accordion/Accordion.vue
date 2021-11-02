<template>
    <div class="container py-6">
        <Accordion
            v-for="(item, index) in repeatable.items"
            :key="index"
            :title="item.title"
        >
            {{ item.text }}
        </Accordion>
    </div>
</template>

<script setup lang="ts">
import { defineProps } from 'vue';
import { Accordion } from '@/components';
defineProps({
    repeatable: {
        type: Object,
    },
});
</script>
