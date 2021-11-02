<template>
    <Menu as="div" class="relative z-10 inline-block text-left">
        <MenuButton>
            {{ locale }}
        </MenuButton>
        <MenuItems
            class="absolute right-0 mt-2 text-gray-900 origin-top-right bg-gray-100 shadow "
        >
            <MenuItem
                v-slot="{ active }"
                v-for="(link, locale) in localize as any"
                :key="locale"
            >
                <a :href="link" class="block px-3">
                    {{ locale }}
                </a>
            </MenuItem>
        </MenuItems>
    </Menu>
</template>

<script setup lang="ts">
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue';
import { locale, localize } from '@/modules/Localize';
</script>
