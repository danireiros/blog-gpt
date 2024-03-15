<template>
    <div class="mt-2">
        <Link v-if="links.prev_page_url" as="button" class="link-button-default mb-3 hover:text-gray-100" :href="links.prev_page_url">Anterior</Link>
        <span v-if="links.prev_page_url && links.next_page_url" class="mx-2"></span>
        <Link v-if="links.next_page_url" as="button" class="link-button-default mb-3 hover:text-gray-100" :href="links.next_page_url">Siguiente</Link>
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
    }, 
}
</script>