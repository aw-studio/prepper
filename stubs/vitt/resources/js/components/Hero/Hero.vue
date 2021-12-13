<template>
    <div
        class="container my-12"
        :class="{
            'flex flex-row-reverse ': sm,
        }"
    >
        <div
            :class="{
                'w-full': !sm,
                'w-1/2': sm,
            }"
        >
            <LitImage
                :image="form.hero_image"
                v-if="form.hero_image"
                class="w-full"
            />
        </div>
        <div
            :class="{
                'relative mb-32': !sm,
                'w-1/2 bg-gray-100 flex items-center p-12': sm,
            }"
        >
            <div
                :class="{
                    'absolute left-0 bottom-0 -mb-16 w-full md:w-1/2 lg:w-1/3 bg-white py-8 px-12 ml-16':
                        !sm,
                }"
            >
                <div
                    class="h2"
                    v-html="form.hero_headline"
                    v-if="form.hero_headline"
                ></div>
                <p v-html="form.hero_text" v-if="form.hero_text"></p>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
defineProps({
    form: {
        type: Object,
        required: true,
    },
    sm: {
        type: Boolean,
        default: false,
    },
});
</script>
