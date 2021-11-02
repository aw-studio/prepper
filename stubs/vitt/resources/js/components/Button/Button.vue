<template>
    <component
        :is="tag"
        class="inline-flex items-center justify-center h-10 px-5"
        :class="{
            'bg-primary hover:bg-primary-700 text-white active:bg-primary-700 focus:ring-primary-300':
                !outline,
            'bg-white hover:bg-primary-700 hover:text-white border border-primary text-primary active:bg-primary-700 focus:ring-primary-300':
                outline,
        }"
        :target="target"
    >
        <slot />
    </component>
</template>

<script setup lang="ts">
import { useAttrs } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const attrs = useAttrs();
const props = defineProps({
    external: {
        type: Boolean,
        default: false,
    },
    target: {
        type: String,
        default: null,
    },
    outline: {
        type: Boolean,
        default: false,
    },
});

const tag = 'href' in attrs ? (props.external ? 'a' : Link) : 'button';
</script>
