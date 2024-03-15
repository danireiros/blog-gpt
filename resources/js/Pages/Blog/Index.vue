<template>
    <BlogLayout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mt-5">

                <div v-if="posts.data.length > 0" class="grid grid-cols-1 sm:grid-cols-2 gap-3 h" >
                    <div v-for="p in posts.data.slice(0, 2)" :key="p.id">
                        <div class="p-5 w-full">
                            <a :href="route('blog.post.show', p.id)">
                                <img class="hover:scale-105 transition-all object-cover h-96 w-full rounded-lg" 
                                :src="'/image/post/'+p.image" 
                                alt="" />
                            </a>
                            <div class="mt-3">
                                <a :href="route('blog.post.show', p.id)">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ p.title }}</h5>
                                </a>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400" v-html="p.description"></p>
                                <div class="inline-flex text-gray-500">
                                    <img class="h-8 w-8 rounded-full mr-3" :src="'/image/author/'+p.author.image"><small class="mt-1">{{ p.author.name }} - {{ formatDate(p.created_at) }}</small>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div> 
                <div v-if="posts.data.length > 0" class="grid grid-cols-1 sm:grid-cols-3 gap-3 flex justify-center" >
                    <div v-for="p in posts.data.slice(2)" :key="p.id">
                        <div class="p-5 w-full ">
                            <a :href="route('blog.post.show', p.id)">
                                <img class="object-cover hover:scale-105 transition-all h-72 w-full rounded-lg" 
                                :src="'/image/post/'+p.image" 
                                alt="" />
                            </a>
                            <div class="mt-3">
                                <a :href="route('blog.post.show', p.id)">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ p.title }}</h5>
                                </a>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400" v-html="p.description"></p>
                                <div class="inline-flex text-gray-500">
                                    <img class="h-8 w-8 rounded-full mr-3" :src="'/image/author/'+p.author.image"><small class="mt-1">{{ p.author.name }} - {{ formatDate(p.created_at) }}</small>
                                </div>
                            </div>
                        </div>
                    </div> 
                    
                </div>
                <div v-if="posts.data.length > 0" class="w-full p-5" >
                    <small>Mas noticias</small>
                    <pagination :links="posts"/>
                </div>
                <div v-else>
                    <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
                        <p>No hay artículos</p>
                    </div>
                </div>
            </div>
        </div>
    </BlogLayout>
</template>

<script>
    import { Link, router } from '@inertiajs/vue3';

    import BlogLayout from "@/Layouts/BlogLayout.vue";
    import Pagination from '@/Shared/PaginationPrevNext.vue';
    
    export default {
        methods: {
            formatDate(dateString) {
                const date = new Date(dateString);
                let options = {
                    year: "numeric",
                    month: "long",
                    day: "numeric",
                    hour: "numeric",
                    minute: "numeric",
                    hour12: false,
                };
                return new Intl.DateTimeFormat(undefined, options).format(date);
            }
        },
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