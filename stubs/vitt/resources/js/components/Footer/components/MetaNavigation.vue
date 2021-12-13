<template>
    <nav class="pt-2 pb-10 bg-gray-100">
        <div class="container flex justify-end space-x-10">
            <Link
                :href="link.route"
                v-for="(link, index) in metaNavigation.data"
                :key="index"
                class="text-base font-bold no-underline border-none  text-primary hover:text-primary"
            >
                {{ link.title }}
            </Link>
        </div>
    </nav>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/inertia-vue3';
import { metaNavigation } from '@/modules/Navigation';
</script>
