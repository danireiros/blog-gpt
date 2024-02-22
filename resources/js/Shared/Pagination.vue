<template>
    <div class="mt-2">
        <Component v-for="l in links.links" :key="l" 
            :is="!l.active ? 'Link' : 'span'" 
            class="px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 hover:bg-gray-50 ml-2" 
            :class="!l.active ? '' : 'cursor-pointer text-gray-800 bg-gray-200 hover:bg-gray-200'" 
            :href="l.url" v-html="l.label"/>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';
export default {
    components: {
        Link,
    },
    props: {
        links: Object,
    }
}
</script>