<template>
    <!-- https://headlessui.dev/vue/disclosure -->
    <div class="container py-6">
        <section class="grid grid-cols-12 gap-6 mb-12">
            <div class="order-2 md:order-1 col-span-full md:col-span-8">
                <LitBlock
                    :block="repeatable.content"
                    :repeatables="ContentRepeatables"
                />
            </div>
            <div class="order-1 md:order-2 col-span-full md:col-span-4">
                <LitBlock
                    :block="repeatable.aside"
                    :repeatables="AsideRepeatables"
                />
            </div>
        </section>
    </div>
</template>

<script setup lang="ts">
import { defineProps } from 'vue';
import { ContentRepeatables, AsideRepeatables } from '@/Repeatables';
defineProps({
    repeatable: {
        type: Object,
    },
});
</script>
