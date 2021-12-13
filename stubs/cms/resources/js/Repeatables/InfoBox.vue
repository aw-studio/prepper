<template>
    <section class="container">
        <div class="flex justify-center">
            <Infobox :infobox="repeatable" />
        </div>
    </section>
</template>

<script setup lang="ts">
import { Infobox } from '@/components';
defineProps({
    repeatable: {
        type: Object,
    },
});
</script>
