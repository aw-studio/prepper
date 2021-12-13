<template>
    <header
        :class="{ '-translate-y-20 md:-translate-y-28': !showNavbar }"
        class="sticky top-0 z-30 w-screen transition-transform duration-200 transform bg-gray-100 "
    >
        <div class="container flex items-center justify-between py-4 lg:py-10">
            <Logo class="w-32 h-auto" />
            <NavigationDesktop class="hidden lg:flex" />
            <BurgerButton class="lg:hidden" />
        </div>
    </header>
    <nav class="relative z-20 lg:hidden">
        <NavigationMobile />
    </nav>
</template>

<script setup lang="ts">
import { onBeforeUnmount, onMounted, ref } from 'vue';
import Logo from './components/Logo.vue';
import BurgerButton from './components/BurgerButton.vue';
import NavigationDesktop from './components/NavigationDesktop.vue';
import NavigationMobile from './components/NavigationMobile.vue';
import { mainNavigationActive } from '@/modules/Navigation';
import { Localize } from '@/components';

const showNavbar = ref(true);
const lastScrollPosition = ref(0);

const onScroll = () => {
    const currentScrollPosition =
        window.pageYOffset || document.documentElement.scrollTop;
    // Because of momentum scrolling on mobiles, we shouldn't continue if it is less than zero
    if (Math.abs(currentScrollPosition - lastScrollPosition.value) < 100) {
        return;
    }
    // Here we determine whether we need to show or hide the navbar
    showNavbar.value = currentScrollPosition < lastScrollPosition.value;
    // Set the current scroll position as the last scroll position
    lastScrollPosition.value = currentScrollPosition;
    mainNavigationActive.value = false;
};

onMounted(() => {
    window.addEventListener('scroll', onScroll);
});
onBeforeUnmount(() => {
    window.removeEventListener('scroll', onScroll);
});
</script>
