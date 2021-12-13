<template>
    <div v-if="repeatable.image.length == 1" class="container mb-16">
        <Image :image="repeatable.image" />
    </div>
    <div v-else class="container mb-16">
        <ImageGallery :images="repeatable.image" />
    </div>
</template>

<script lang="ts" setup>
import { defineComponent, onMounted, ref } from 'vue';
import { Image, ImageGallery } from '@/components';
defineProps({
    repeatable: {
        type: Object,
    },
});
</script>
