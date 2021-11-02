<template>
    <Header />
    <main>
        <slot />
    </main>
    <Footer />
</template>

<script setup lang="ts">
import { Header, Footer } from '@/components';
</script>
