<template>
    <div v-if="images.length > 0" class="">
        <h3>{{ title }}</h3>
        <div class="hidden md:grid md:grid-cols-12 md:gap-5">
            <button
                v-for="(image, index) in images"
                :key="index"
                @click="toggleGallery(image.id, index)"
                class="relative col-span-12 transition-all duration-300 cursor-pointer  md:col-span-6 lg:col-span-4 xl:col-span-3 focus:outline-none focus:ring-offset-1 focus:ring focus:ring-opacity-75 focus:ring-primary-500"
            >
                <LitImage
                    :image="image"
                    container="h-64 object-cover"
                    class="object-cover w-full h-64"
                />
            </button>
        </div>
        <div class="grid grid-cols-12 gap-5 md:hidden">
            <div
                v-for="(image, index) in images"
                :key="index"
                class="relative col-span-12 transition-all duration-300  md:col-span-6 lg:col-span-4 xl:col-span-3"
            >
                <LitImage :image="image" class="w-full h-full" />
            </div>
        </div>
        <ImageGalleryModal v-model:open="openModal">
            <div
                :id="`${image.id}_${index}`"
                v-for="(image, index) in images"
                :key="index"
                class="mb-20"
            >
                <LitImage :image="image" class="w-full" />
            </div>
        </ImageGalleryModal>
    </div>
</template>

<script lang="ts" setup>
import { defineComponent, PropType, ref, nextTick } from 'vue';
import { ImageGalleryModal } from '@/components';
import { Image } from './image.interface';

const props = defineProps({
    images: {
        type: Array as PropType<Image[]>,
        default: () => [],
    },
    title: {
        type: String as PropType<String>,
        default: 'Bilder Galerie',
    },
});

const openModal = ref(false);

const toggleGallery = (imageId: number, index: number): void => {
    openModal.value = true;

    nextTick(() => {
        const scrollElement = document.getElementById(`${imageId}_${index}`);
        setTimeout(() => {
            scrollElement?.scrollIntoView({
                behavior: 'smooth',
                block: 'end',
            });
        }, 100);
    });
};
</script>
