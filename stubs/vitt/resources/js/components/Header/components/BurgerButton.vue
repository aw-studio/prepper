<template>
    <button
        class="p-3 -mr-3 rounded-md  active:bg-primary focus:ring-1 focus:ring-primary-300 focus:outline-none"
        @click="toggle()"
    >
        <div class="relative z-20 w-5 h-3.5">
            <div
                :class="{
                    'top-1/2 rotate-45': mainNavigationActive,
                    'top-0': !mainNavigationActive,
                }"
                class="absolute top-0 w-full h-px transition-all duration-300 transform bg-gray-900 rounded-full "
            ></div>
            <div
                :class="{
                    'bg-opacity-0': mainNavigationActive,
                    'bg-opacity-100': !mainNavigationActive,
                }"
                class="absolute w-full h-px transition-all duration-300 transform bg-gray-900 rounded-full  top-1/2"
            ></div>
            <div
                :class="{
                    'top-1/2 -rotate-45': mainNavigationActive,
                    'top-full': !mainNavigationActive,
                }"
                class="absolute w-full h-px transition-all duration-300 transform bg-gray-900 rounded-full "
            ></div>
        </div>
    </button>
</template>

<script setup lang="ts">
import { mainNavigationActive } from '@/modules/Navigation';
const toggle = () => {
    mainNavigationActive.value = !mainNavigationActive.value;
};
</script>
