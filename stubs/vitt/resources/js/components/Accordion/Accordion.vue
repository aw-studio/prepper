<template>
    <Disclosure>
        <DisclosureButton
            class="flex justify-between w-full px-4 py-2 my-2 bg-gray-100 rounded-sm  focus:outline-none focus:ring focus:ring-gray-500 focus:ring-opacity-75"
        >
            {{ title }}
        </DisclosureButton>
        <DisclosurePanel class="px-4 pt-4 pb-2">
            <slot />
        </DisclosurePanel>
    </Disclosure>
</template>

<script setup lang="ts">
import { defineProps } from 'vue';
import { Disclosure, DisclosureButton, DisclosurePanel } from '@headlessui/vue';
defineProps({
    title: {
        type: Object,
    },
});
</script>
