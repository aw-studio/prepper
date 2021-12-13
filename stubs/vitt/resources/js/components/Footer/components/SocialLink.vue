<template>
    <div class="flex items-center">
        <a
            class="focus:outline-none focus:ring-1 focus:ring-primary-300"
            target="_blank"
            :href="repeatable.link"
            v-html="repeatable.icon"
        ></a>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
export default defineComponent({
    name: 'SocialLink',
    props: {
        repeatable: {
            type: Object,
        },
    },
    setup(props) {
        //
    },
});
</script>
