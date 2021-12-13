<template>
    <section class="my-12">
        <div class="container grid grid-cols-12 gap-6 py-12">
            <LitBlock
                :block="repeatable.cards"
                :repeatables="CardRepeatables"
            />
        </div>
    </section>
</template>

<script setup lang="ts">
import { CardRepeatables } from '@/Repeatables';
defineProps({
    repeatable: {
        type: Object,
    },
});
</script>
