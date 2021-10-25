<template>
    <lightgallery
        :settings="{ cssEasing: 'cubic-bezier(0.645, 0.045, 0.355, 1)', speed: 500, plugins: lgPlugins, download: false,}"
        class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4"
    >
        <template v-for="image, index in gallery" :key="index">
            <a class="block" :href="image.large">
                <img class="object-cover w-full h-full lazy" :data-src="image.small" alt="" />
            </a>
        </template>
    </lightgallery>
</template>

<script>
import lightgallery from 'lightgallery/vue';

import Lazy from '../mixins/Lazy.vue'

export default {
    props: {
        gallery: Object,
    },

    data() {
        return {
            lgPlugins: []
        }
    },

    components: {
        lightgallery,
    },

    mixins: [Lazy],
};

</script>

<style scoped>
@import 'lightgallery/css/lightgallery.css';
</style>