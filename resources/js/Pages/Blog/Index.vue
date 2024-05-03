<template>
    <BlogLayout>
        <template #catnavs>
            <div v-for="c in categories" :key="c.id">
                <div class="hidden space-x-8 sm:-my-px sm:ms-4 sm:flex h-full">
                    <NavLink :href="route('blog.category', c.title)" :active="route().current('blog.category', c.title)">
                        <img class="h-4 w-4" :src="'/image/category/'+c.image">
                    </NavLink>
                </div>
            </div>
        </template>

        <template #catnavs_responsive>
            <div v-for="c in categories" :key="c.id">
                <ResponsiveNavLink :href="route('blog.category', c.title)" :active="route().current('blog.category', c.title)">
                    <img class="h-4 w-4" :src="'/image/category/'+c.image">
                </ResponsiveNavLink>
            </div>
        </template>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mt-5">

                <div v-if="posts.data.length > 0" class="grid grid-cols-1 sm:grid-cols-2 gap-3 h" >
                    <div v-for="p in posts.data.slice(0, 2)" :key="p.id">
                        <div class="p-5 w-full">
                            <a :href="route('blog.post.show', p.slug)">
                                <img class="hover:scale-105 transition-all object-cover h-96 w-full rounded-lg"
                                :src="'/image/post/'+p.image"
                                alt="" />
                            </a>
                            <div class="mt-3">
                                <a :href="route('blog.post.show', p.slug)">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white hover:text-indigo-800 transition">{{ p.title }}</h5>
                                </a>
                                <p class="">
                                    <a :href="route('blog.category', p.category.title)" class="uppercase font-semibold" :style="'color: '+p.category.color">{{ p.category.title }}</a>
                                </p>

                                <p v-if="p.type == '#ad'" class="mb-2">
                                    <small class="uppercase my-3 font-semibold text-gray-400 block">#Promo</small>
                                </p>
                                <div>
                                    <p class="mb-2 font-normal text-gray-700 dark:text-gray-400" v-html="p.description"></p>
                                </div>
                                <div class="w-100">
                                    <p class="mb-2 inline-flex text-gray-500">
                                        <small>{{ p.comments_count }}</small>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1 mt-1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                                        </svg>
                                    </p>
                                </div>
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
                            <a :href="route('blog.post.show', p.slug)">
                                <img class="object-cover hover:scale-105 transition-all h-72 w-full rounded-lg"
                                :src="'/image/post/'+p.image"
                                alt="" />
                            </a>
                            <div class="mt-3">
                                <a :href="route('blog.post.show', p.slug)">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white hover:text-indigo-800 transition">{{ p.title }}</h5>
                                </a>
                                <p class="mb-2">
                                    <a :href="route('blog.category', p.category.title)" class="uppercase font-semibold" :style="'color: '+p.category.color">{{ p.category.title }}</a>
                                </p>
                                <p v-if="p.type == '#ad'" class="mb-2">
                                    <small class="uppercase my-3 font-semibold text-gray-400 block">#Promo</small>
                                </p>
                                <div>
                                    <p class="mb-2 font-normal text-gray-700 dark:text-gray-400" v-html="p.description"></p>
                                </div>
                                <div class="w-100">
                                    <p class="mb-2 inline-flex text-gray-500">
                                        <small>{{ p.comments_count }}</small>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1 mt-1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                                        </svg>
                                    </p>
                                </div>
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
    import NavLink from '@/Components/NavLink.vue';
    import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

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
            NavLink,
            ResponsiveNavLink,
        },
        props: {
            posts: Object,
            categories: Object,
        }
    }
</script>
