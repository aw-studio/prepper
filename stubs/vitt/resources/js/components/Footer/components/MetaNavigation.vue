<template>
    <nav class="bg-gray-700 py-2">
        <div class="container flex justify-end space-x-2">
            <Link
                :href="link.route"
                v-for="(link, index) in metaNavigation.data"
                :key="index"
                class="
                    text-white
                    hover:text-gray-200
                    no-underline
                    border-none
                    text-sm
                "
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
