<template>
    <div class="container mt-0 m-auto p-5 pt-0">
        <h2 class="mb-4 mt-0 text-2xl font-bold tracking-tight text-gray-700 dark:text-white">
            {{ comments.length }}
            <span v-if="comments.length == 1">Comentario</span>
            <span v-else>Comentarios</span>
        </h2>
            <div v-for="comment in comments" :key="comment.id">
                <div v-if="!comment.parent_comment_id">
                    <div class="w-100 inline-flex">
                        <img class="h-8 w-8 rounded-full"
                        :src="'/image/'+comment.user.profile_photo_path"
                        alt="" />

                        <span class="ml-4 mt-1 font-bold">{{ comment.user.name }}</span>
                        <span class="ml-4 mt-1 text-gray-400">{{ formatDate(comment.created_at) }}</span>
                    </div>
                    <p class="text-gray-500" style="font-weight: 500;">{{ comment.text }}</p>
                    <p class="mb-8 inline-flex text-indigo-300">
                        <small>{{ comment.likes }}</small>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1 cursor-pointer" style="margin-top: 3px;" @click="likeComment(comment.id)">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                        </svg>
                        <small class="ml-2 cursor-pointer" @click="replyToComment(comment.id)">Responder</small>
                    </p>
                </div>

                <!-- Respuestas -->
                <div v-for="reply in comments" :key="reply.id" class="ml-8">
                    <div v-if="reply.parent_comment_id == comment.id">
                        <div class="w-100 inline-flex">
                            <img class="h-8 w-8 rounded-full"
                            :src="'/image/'+reply.user.profile_photo_path"
                            alt="" />

                            <span class="ml-4 mt-1 font-bold">{{ reply.user.name }}</span>
                            <span class="ml-4 mt-1 text-gray-400">{{ formatDate(reply.created_at) }}</span>
                        </div>
                        <p class="text-gray-500" style="font-weight: 500;">{{ reply.text }}</p>
                        <p class="mb-8 inline-flex text-indigo-300">
                            <small>{{ reply.likes }}</small>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1 cursor-pointer" style="margin-top: 3px;" @click="likeComment(reply.id)">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                            </svg>
                        </p>
                    </div>
                </div>
            </div>
        <hr>
        <FormSection2 @submitted="submit" v-if="isLoggedIn">
            <template #form>
                <div class="col-span-6">
                    <InputLabel for="" v-if="replyingTo !== null">
                        Responder a <strong>{{ comments.find(c => c.id === replyingTo).user.name }}</strong>
                        <button @click="cancelReply" class="ml-2 text-red-500 hover:text-red-700">Cancelar respuesta</button>
                    </InputLabel>
                    <InputLabel for="" v-else>Comentar</InputLabel>
                    <textarea maxlength="200" id="comment-textarea" v-model="form.text" class="p-3 h-48 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full"></textarea>
                    <p>Caracteres restantes: {{ caracteresRestantes }}</p>
                </div>
            </template>
            <template #actions>
                <PrimaryButton class="link-button-default mb-3 hover:text-gray-100 mt-2 hover:cursor-pointer" @click.prevent="submit">Publicar</PrimaryButton>
            </template>
            <Link as="button" class="link-button-default mb-3 hover:text-gray-100" :href="route('post.edit', 1)">Publicar</Link>
        </FormSection2>
        <div v-else>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="container my-2 rounded-sm shadow-sm bg-purple-100 border-l-4 border-purple-500 text-purple-700 p-4" role="alert">
                    <p>Unase a nuestra comunidad para poder comentar 🗣️🫂</p>
                    <a :href="route('login')" :active="route().current('login')" class="link-button-default mb-3 hover:text-gray-100 mt-2 hover:cursor-pointer">
                        Unirse
                    </a>
                    <a :href="route('register')" :active="route().current('register')" class="ml-4 link-button-default mb-3 hover:text-gray-100 mt-2 hover:cursor-pointer">
                        Registrarse
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { ref, computed } from 'vue';
    import { useForm, Link, router } from '@inertiajs/vue3';
    import FormSection2 from "@/Components/FormSection2.vue";
    import InputLabel from "@/Components/InputLabel.vue";
    import PrimaryButton from "@/Components/PrimaryButton.vue";
    import NavLink from '@/Components/NavLink.vue';

    export default {
        data() {
            return {
                form: {
                    text: ''
                }
            };
        },
        computed: {
            caracteresRestantes() {
                if (this.form.text === null) {
                    return 200;
                }
                return 200 - this.form.text.length;
            }
        },
        components: {
            Link,
            FormSection2,
            InputLabel,
            useForm,
            NavLink
        },
        props:{
            errors: Object,
            comments: Object,
            post_id: Number,
            user: String,
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
        setup(props) {
            const form = useForm({
                text: null,
                parent_comment_id: null,
                post_id: props.post_id,
            }, {
                preserveState: true,
                preserveScroll: true
            });

            const replyingTo = ref(null); // Estado para indicar a qué comentario se está respondiendo

            const likeComment = async (commentId) => {
                try {
                    const response = await axios.post(route('comments.like', commentId));
                    const { likes } = response.data;
                    const commentIndex = props.comments.findIndex(comment => comment.id === commentId);
                    if (commentIndex !== -1) {
                        props.comments[commentIndex].likes = likes;
                    }
                } catch (error) {
                    console.error('Error al dar like al comentario:', error);
                }
            };

            const replyToComment = (commentId) => {
                replyingTo.value = commentId;
                document.querySelector('#comment-textarea').scrollIntoView({
                    behavior: 'smooth'
                });
                form.parent_comment_id = commentId;
            };

            const submit = async () => {
                try {
                    if (replyingTo.value !== null) {
                        form.parent_comment_id = replyingTo.value;
                    }

                    await router.post(route('comments.store', form));

                    form.reset();
                    replyingTo.value = null;
                } catch (error) {
                    console.error('Error al enviar el comentario:', error);
                }
            };

            const cancelReply = () => {
                replyingTo.value = null;
                form.parent_comment_id = null;
            };

            const isLoggedIn = computed(() => props.user === 'logged');

            return { form, submit, likeComment, replyToComment, replyingTo, cancelReply, isLoggedIn };
        },
    }
</script>
