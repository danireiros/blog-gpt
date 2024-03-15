<template>
    <AppLayout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mt-5">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">OpenAi</h2>
                        <Link class="link-button-default mb-3 hover:text-gray-100" :href="route('openai.completion')">Redactar noticia aleatoria</Link>
                    
                        <div v-if="content">
                            <h2 class="mb-2 font-semibold text-gray-900 dark:text-white">Autor</h2>
                            <img class="h-16 w-16 rounded-full" :src="'/image/author/'+author.image">
                            <p>{{ author.name }}</p>
                            <p class="italic">{{ author.system_prompt }}</p>
                            <hr>
                            <img :src="'/image/post/'+post.image" class="w-full h-96">
                            <h2 class="mt-5 mb-2 font-semibold text-gray-900 dark:text-white">Mensaje</h2>

                            <div v-html="content"></div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<script>
import { Link, router } from '@inertiajs/vue3';
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
    components: {
        Link,
        AppLayout,
    },
    props: {
        content: String,
        author: Object,
        post: Object,
    }
}
</script>