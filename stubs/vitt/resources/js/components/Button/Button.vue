<template>
    <component
        :is="tag"
        class="inline-flex items-center justify-center h-10 px-5 font-semibold"
        :href="routeUrl"
        :class="{
            'bg-primary hover:bg-primary text-white hover:text-white active:bg-primary focus:ring-primary-300':
                !outline,
            'bg-white hover:bg-primary hover:text-white border-2 border-primary text-primary active:bg-primary focus:ring-primary-300':
                outline,
        }"
        :target="target"
    >
        <slot />
    </component>
</template>

<script setup lang="ts">
import { computed, useAttrs } from 'vue';
import { Link, usePage } from '@inertiajs/inertia-vue3';

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
    route: {
        type: String,
        default: null,
    },
});

const routeUrl = computed(() => {
    const routes = usePage().props.value.routes as any;
    if (props.route) {
        return routes[props.route?.replace('app.', '')];
    }
});

const tag =
    'href' in attrs || props.route ? (props.external ? 'a' : Link) : 'button';
</script>
