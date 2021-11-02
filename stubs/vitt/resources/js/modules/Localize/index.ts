import { computed } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';

export const locale = computed(() => usePage().props.value.locale);
export const localize = computed(() => usePage().props.value.localize);