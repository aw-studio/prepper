<template>
    <transition
        enter-active-class="transition duration-200 ease-out"
        enter-from-class="-translate-y-full"
        enter-to-class="translate-y-0"
        leave-active-class="transition duration-100 ease-in"
        leave-from-class="translate-y-0 "
        leave-to-class="-translate-y-full"
    >
        <div v-if="mainNavigationActive" class="transform bg-white mobile-nav">
            <div class="container">
                <div v-for="(link, index) in mainNavigation.data" :key="index">
                    <Link
                        :href="link.route"
                        class="font-semibold text-gray-900  hover:text-gray-500 hover:border-gray-500"
                        @click="closeNav()"
                    >
                        {{ link.title }}
                    </Link>

                    <div v-if="link.children.length > 0" class="pl-4">
                        <Link
                            v-for="child in link.children"
                            :href="child.route"
                        >
                            {{ child.title }}
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/inertia-vue3';
import { mainNavigation, mainNavigationActive } from '@/modules/Navigation';

const closeNav = () => {
    mainNavigationActive.value = false;
};
</script>

<style scoped>
.mobile-nav {
    position: fixed;
    left: 0;
    top: 0;
    padding-top: 100px;
    width: 100vw;
    height: 100vh;
    z-index: -1;
}
</style>
