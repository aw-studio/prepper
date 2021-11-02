<template>
    <div class="container pb-8">
        <LitImage :image="image" v-if="image" class="w-full" />
    </div>
</template>

<script setup lang="ts">
import { computed } from 'vue';
const props = defineProps({
    repeatable: {
        type: Object,
    },
});

const image = computed(() => {
    if (Array.isArray(props.repeatable?.image)) {
        return props.repeatable?.image[0];
    }
    return props.repeatable?.image;
});
</script>
