<template>
    <nav class="relative justify-end w-full space-x-4">
        <NavigationLink
            v-for="(link, index) in mainNavigation.data"
            :key="index"
            :link="link"
        />
    </nav>
</template>

<script setup lang="ts">
import NavigationLink from './NavigationLink.vue';
import { mainNavigation } from '@/modules/Navigation';
</script>
