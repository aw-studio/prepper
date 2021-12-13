<template>
    <Infobox :infobox="repeatable" />
</template>

<script lang="ts" setup>
import { Infobox } from '@/components';

defineProps({
    repeatable: {
        type: Object,
    },
});
</script>
