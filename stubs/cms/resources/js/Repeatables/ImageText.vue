<template>
    <div class="container">
        <div class="grid grid-cols-2 gap-10 mb-16">
            <div
                class="col-span-2 md:col-span-1"
                :class="repeatable.text_first ? 'order-2' : 'order-1'"
            >
                <LitImage
                    v-if="repeatable.image"
                    :image="repeatable.image"
                    class="w-full h-full"
                />
            </div>
            <div
                class="col-span-2 md:col-span-1"
                :class="repeatable.text_first ? 'order-1' : 'order-2'"
            >
                {{ repeatable.text }}
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
defineProps({
    repeatable: {
        type: Object,
    },
});
</script>
