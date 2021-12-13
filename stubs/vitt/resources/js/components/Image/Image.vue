<template>
    <LitImage :image="image" v-if="image" class="w-full" />
</template>

<script lang="ts" setup>
import { defineComponent, onMounted, ref } from 'vue';
import 'lazysizes';

defineProps({
    image: {
        type: [Object, Array],
        required: true,
    },
});
</script>
