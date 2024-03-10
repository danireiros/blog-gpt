<template>
    <BlogLayout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mt-5">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">Últimos artículos</h2>
                        <div v-if="posts.data.length > 0">
                            
                            <div class="border-b" v-for="p in posts.data" :key="p.id">
                                <h2 class="p-2">{{ p.title }}</h2>
                            </div>

                            <pagination :links="posts"/>
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
    </BlogLayout>
</template>

<script>
    import { Link, router } from '@inertiajs/vue3';

    import BlogLayout from "@/Layouts/BlogLayout.vue";
    import Pagination from '@/Shared/Pagination.vue';
    import ConfirmationModal from "@/Components/ConfirmationModal.vue";
    
    export default {
        components: {
            Link,
            BlogLayout,
            Pagination,
        },
        props: {
            posts: Object,
        }
    }
</script>