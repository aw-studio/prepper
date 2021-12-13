<template>
    <Meta title="Kontakt" />
    <Hero v-if="form.has_hero" :form="form" />
    <div class="container mt-16">
        <h1>{{ form.h1 }}</h1>
    </div>
    <LitBlock :block="form.content" :repeatables="ContentRepeatables" />
    <div class="container w-full py-16 h-96">
        <Map :lat="54.3242466" :lng="10.1420931" />
    </div>
</template>

<script setup lang="ts">
import { Meta, Hero, Map } from '@/components';
import { ContentRepeatables } from '@/Repeatables';
defineProps({
    form: {
        type: Object,
        required: true,
    },
});
</script>
