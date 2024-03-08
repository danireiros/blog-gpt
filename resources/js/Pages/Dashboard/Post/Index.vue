<template>

    <confirmation-modal :show="confirmDeleteActive">
        <template v-slot:title> Confirme la acción </template>

        <template v-slot:content>
            <p>¿Seguro que quieres eliminar el post?</p>
        </template>

        <template v-slot:footer>
            <o-button variant="danger" @click="deletePost">Eliminar</o-button>
            <div class="mr-3"></div>
            <o-button @click="confirmDeleteActive = false">Cancelar</o-button>
        </template>
    </confirmation-modal>

    <AppLayout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mt-5">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">Posts</h2>
                        <Link class="link-button-default mb-3 hover:text-gray-100" :href="route('post.create')">Crear</Link>
                        <div v-if="posts.data.length > 0">
                            <table class="w-full border">
                                <thead class="bg-gray-200">
                                    <tr class="border-b">
                                        <!-- <th class="p-3">ID</th> -->
                                        <th class="p-3">Titulo</th>
                                        <th class="p-3">Slug</th>
                                        <th class="p-3">Autor</th>
                                        <th class="p-3">Categoría</th>
                                        <th class="p-3">Descripción</th>
                                        <th class="p-3">Publicado</th>
                                        <th class="p-3">Tipo</th>
                                        <th class="p-3">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b" v-for="p in posts.data" :key="p.id">
                                        <!-- <td class="p-2">{{ p.id }}</td> -->
                                        <td class="p-2">{{ p.title }}</td>
                                        <td class="p-2">{{ p.slug }}</td>
                                        <td class="p-2">{{ p.author.name }}</td>
                                        <td class="p-2">{{ p.category.title }}</td>
                                        <td class="p-2">{{ p.description }}</td>
                                        <td class="p-2">
                                            <div v-if="p.posted == 'yes'">
                                                <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                                    Si
                                                </span>
                                            </div>
                                            <div v-else>
                                                <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                                                    No
                                                </span>
                                            </div>
                                        </td>
                                        <td class="p-2">{{ p.type }}</td>
                                        <td class="p-2">
                                            <Link as="button" class="text-sm text-purple-400 hover:text-purple-700 mx-2" :href="route('post.edit', p.id)">Editar</Link>
                                            <!-- <Link as="button" class="text-sm text-red-400 hover:text-red-700 mx-2" method="delete" :href="route('post.destroy', p.id)">Eliminar</Link> -->
                                            <button class="text-sm text-red-400 hover:text-red-700 mx-2"
                                                @click="confirmDeleteActive = true;deletePostRow = p.id;">Eliminar</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <pagination :links="posts"/>
                        </div>
                        <div v-else>
                            <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
                                <p>No hay posts</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
    import { Link, router } from '@inertiajs/vue3';
    import { ref } from "vue";

    import AppLayout from "@/Layouts/AppLayout.vue";
    import Pagination from '@/Shared/Pagination.vue';
    import ConfirmationModal from "@/Components/ConfirmationModal.vue";
    
    export default {
        data() {
            return {
                confirmDeleteActive: false,
                deletePostRow: "",
            }
        }, 
        methods: {
            deletePost() {
                router.delete(route("post.destroy", this.deletePostRow));
                this.confirmDeleteActive = false;
            }, 
        },
        components: {
            Link,
            AppLayout,
            Pagination,
            ConfirmationModal
        },
        props: {
            posts: Object,
        },
        setup(props) {

        }
    }
</script>
