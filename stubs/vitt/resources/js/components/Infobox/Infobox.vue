<template>
    <div class="w-full p-5 mb-16 text-base bg-gray-100">
        <div class="h3" v-if="infobox.title" v-html="infobox.title"></div>
        <div v-if="infobox.text" v-html="infobox.text"></div>
        <div
            class="flex"
            v-if="
                infobox.link_type == 'internal' ||
                infobox.link_type == 'external'
            "
        >
            <Button
                :route="infobox.route"
                v-if="infobox.link_type == 'internal'"
            >
                mehr erfahren
            </Button>
            <Button
                external
                :href="infobox.external_link"
                target="_blank"
                v-if="infobox.link_type == 'external'"
            >
                mehr erfahren
            </Button>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Button } from '@/components';
defineProps({
    infobox: {
        type: Object,
        required: true,
    },
});
</script>
