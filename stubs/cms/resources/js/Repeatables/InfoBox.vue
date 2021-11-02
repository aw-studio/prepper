<template>
    <section class="container">
        <div class="flex justify-center">
            <Infobox :title="repeatable.title" :text="repeatable.text" />
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
