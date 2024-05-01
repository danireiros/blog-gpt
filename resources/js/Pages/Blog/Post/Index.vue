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
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="container mt-5 m-auto p-5">
                <div v-if="post" class="content-center">
                    <h5 class="mb-8 mt-4 text-4xl font-bold tracking-tight text-gray-900 dark:text-white">{{ post.title }}</h5>
                    <img class="transition-all object-cover w-full rounded-lg"
                    :src="'/image/post/'+post.image"
                    alt="" />
                    <p class="mb-8"><small>{{ formatDate(post.created_at) }}</small></p>
                    <div class="inline-flex text-gray-500 mb-8">
                        <img class="h-8 w-8 rounded-full mr-3" :src="'/image/author/'+post.author.image"><small class="mt-2 font-semibold">{{ post.author.name }}<span class="text-sm text-gray-300 font-thin"> - {{ post.author.description }}</span></small>
                    </div>
                    <p :style="{ fontFamily: 'IBM', fontWeight: 'normal', fontStyle: 'normal' }" class="mb-3 max-w-xl text-xl leading-relaxed font-normal text-gray-700 dark:text-gray-400" v-html="post.text"></p>
                </div>
                <div v-else>
                    <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4 mt-8" role="alert">
                        <p>Ups! No tenemos ni idea donde está este artículo...</p>
                    </div>
                </div>
            </div>

            <hr class="mb-0">
            <CommentSection :post_id="post.id"></CommentSection>

        </div>
    </BlogLayout>
</template>

<script>
    import { Link, router } from '@inertiajs/vue3';

    import BlogLayout from "@/Layouts/BlogLayout.vue";
    import Pagination from '@/Shared/Pagination.vue';
    import NavLink from '@/Components/NavLink.vue';
    import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

    import CommentSection from '@/Components/Post/CommentSection.vue';

    export default {
        data() {
            return {
            font: 'MiFuente, sans-serif' // Reemplaza 'MiFuente' con el nombre de tu fuente
            };
        },
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
            CommentSection,
        },
        props: {
            post: Object,
            categories: Object,
        }
    }
</script>
