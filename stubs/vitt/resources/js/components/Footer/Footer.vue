<template>
    <footer class="py-16 mt-auto bg-gray-100">
        <div class="container">
            <div v-html="footer.info_text"></div>
            <div class="flex flex-col flex-wrap space-x-6 md:flex-row">
                <LitBlock :block="footer.social" :repeatables="repeatables" />
            </div>
        </div>
    </footer>
    <MetaNavigation />
</template>

<script setup lang="ts">
import { usePage } from '@inertiajs/inertia-vue3';
import { computed } from 'vue';
import MetaNavigation from './components/MetaNavigation.vue';
import SocialLink from './components/SocialLink.vue';

const footer = computed(() => usePage().props.value.footer);
const repeatables = { SocialLink: SocialLink };
</script>
