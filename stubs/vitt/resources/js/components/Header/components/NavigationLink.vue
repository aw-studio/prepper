<template>
    <Link
        v-if="link.children.length == 0"
        :href="link.route"
        :class="{
            'text-primary': isCurrent(link.route),
        }"
    >
        {{ link.title }}
    </Link>
    <Popover v-slot="{ open }" v-else>
        <PopoverButton
            :as="'button'"
            class="flex items-center"
            :class="{
                'text-primary': isCurrent(link.route),
            }"
        >
            {{ link.title }}

            <svg
                class="w-4 h-4 transition-transform duration-75 fill-current"
                :class="{
                    'transform rotate-180': open,
                }"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="-5 -8 24 24"
                width="24"
                fill="currentColor"
            >
                <path
                    d="M7.071 5.314l4.95-4.95a1 1 0 1 1 1.414 1.414L7.778 7.435a1 1 0 0 1-1.414 0L.707 1.778A1 1 0 1 1 2.121.364l4.95 4.95z"
                ></path>
            </svg>
        </PopoverButton>

        <transition
            enter-active-class="transition duration-200 ease-out"
            enter-from-class="translate-y-1 opacity-0"
            enter-to-class="translate-y-0 opacity-100"
            leave-active-class="transition duration-150 ease-in"
            leave-from-class="translate-y-0 opacity-100"
            leave-to-class="translate-y-1 opacity-0"
        >
            <PopoverPanel
                v-slot="{ close }"
                class="absolute right-0 z-40 w-screen max-w-sm px-4 mt-4 transform  sm:px-0 lg:max-w-3xl"
            >
                {{ initClose(close) }}
                <div class="overflow-hidden rounded shadow">
                    <div class="grid grid-cols-12 bg-gray-100">
                        <div class="p-8 col-span-full lg:col-span-4">
                            <Link
                                :href="link.route"
                                class="inline-flex"
                                @finish="closePopover(close)"
                            >
                                {{ link.title }}
                            </Link>
                        </div>
                        <div
                            class="col-span-12 p-8 border-gray-200  lg:border-l lg:col-span-8"
                        >
                            <Link
                                v-for="child in link.children"
                                :href="child.route"
                                @finish="closePopover(close)"
                                :class="{
                                    'text-primary': isCurrent(child.route),
                                }"
                            >
                                {{ child.title }}
                            </Link>
                        </div>
                    </div>
                </div>
            </PopoverPanel>
        </transition>
    </Popover>
</template>

<script setup lang="ts">
import { onMounted, ref } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';
import { isCurrent } from '@/modules/Navigation';
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue';

defineProps({
    link: {
        type: Object,
        required: true,
    },
});

const closePopover = (close: any) => {
    close();
};

const initClose = (close: any) => {
    window.addEventListener(
        'scroll',
        () => {
            close();
        },
        { once: true }
    );
};
</script>
