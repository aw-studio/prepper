import { computed, ref } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';

export const mainNavigation: any = computed(
    () => usePage().props.value.mainNavigation
);

export const metaNavigation: any = computed(
    () => usePage().props.value.metaNavigation
);

export const isCurrent = (link: string) => {
    let path = link.replace(`${location.protocol}//${location.host}`, '');
    
    if (path == '') {
        path = '/';
        return path == location.pathname
    }

    return location.pathname.includes(path);
};

export const mainNavigationActive: any = ref(false)