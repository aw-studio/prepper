<template>
    <div
        class="flex flex-col col-span-12 bg-white border-2  border-gray md:col-span-6 lg:col-span-4"
    >
        <LitImage
            v-if="repeatable.image"
            :image="repeatable.image"
            class="w-full"
        />
        <div class="flex flex-col w-full h-full p-6">
            <div class="pb-2 font-bold">{{ repeatable.title }}</div>
            <div class="mb-10">
                {{ repeatable.text }}
            </div>
            <div
                class="flex justify-end mt-auto"
                v-if="
                    repeatable.link_type == 'internal' ||
                    repeatable.link_type == 'external'
                "
            >
                <Button
                    outline
                    :route="repeatable.route"
                    v-if="repeatable.link_type == 'internal'"
                >
                    mehr erfahren
                </Button>
                <Button
                    outline
                    external
                    :href="repeatable.external_link"
                    target="_blank"
                    v-if="repeatable.link_type == 'external'"
                >
                    mehr erfahren
                </Button>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Button } from '@/components';
defineProps({
    repeatable: {
        type: Object,
    },
});
</script>
