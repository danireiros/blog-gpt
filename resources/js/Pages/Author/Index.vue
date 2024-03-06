<template>
    <AppLayout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mt-5">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">Autores</h2>
                        <Link class="link-button-default mb-3 hover:text-gray-100" :href="route('author-general.create')">Crear</Link>
                        <div v-if="authors.data.length > 0">
                        
                        </div>
                        <div v-else>
                            <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
                                <p>No hay autores</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
    import { Link } from "@inertiajs/vue3";
    import AppLayout from "@/Layouts/AppLayout.vue";

    export default {
        components:{
            Link,
            AppLayout
        },
        props: {
            authors: Object,
        },
    }
</script>