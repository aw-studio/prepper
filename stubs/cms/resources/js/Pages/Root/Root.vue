<template>
    <Meta title="Home" />
    <Hero sm v-if="form.has_hero" :form="form" />
    <div class="container">
        <h1>{{ form.h1 }}</h1>
    </div>
    <LitBlock :block="form.content" :repeatables="ContentRepeatables" />
</template>

<script setup lang="ts">
import { defineProps } from 'vue';
import { Meta, Hero } from '@/components';
import { ContentRepeatables } from '@/Repeatables';
defineProps({
    form: {
        type: Object,
        required: true,
    },
});
</script>
