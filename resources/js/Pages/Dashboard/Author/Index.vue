<template>
    <confirmation-modal :show="confirmDeleteActive">
        <template v-slot:title> Confirme la acción </template>

        <template v-slot:content>
            <p>¿Seguro que quieres eliminar el autor?</p>
        </template>

        <template v-slot:footer>
            <o-button variant="danger" @click="deleteAuthor">Eliminar</o-button>
            <div class="mr-3"></div>
            <o-button @click="confirmDeleteActive = false">Cancelar</o-button>
        </template>
    </confirmation-modal>

    <AppLayout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mt-5">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">Autores</h2>
                        <div class="mb-2">
                            <InputLabel for="">Categoría</InputLabel>
                            <select @change="customSearch" class="rounded-md w-full border-gray-300" v-model="category_id">
                                <option :value="null">-</option>
                                <option v-for="c in categories" :key="c.id" :value="c.id">
                                    {{ c.title }}
                                </option>
                            </select>
                        </div>
                        <Link class="link-button-default mb-3 hover:text-gray-100" :href="route('author.create')">Crear</Link>
                        <div v-if="authors.data.length > 0">
                            <table class="w-full border">
                                <thead class="bg-gray-200">
                                    <tr class="border-b">
                                        <th class="p-3">ID</th>
                                        <th class="p-3">Imagen</th>
                                        <th class="p-3">Nombre</th>
                                        <th class="p-3">Descripcion</th>
                                        <th class="p-3">Prompt</th>
                                        <th class="p-3">Categoria</th>
                                        <th class="p-3">Subcategoria</th>
                                        <th class="p-3">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b" v-for="a in authors.data" :key="a.id">
                                        <td class="p-2">{{ a.id }}</td>
                                        <td class="p-2">
                                            <img class="h-16 w-16 rounded-full" :src="'/image/author/'+a.image">
                                        </td>
                                        <td class="p-2 font-bold">{{ a.name }}</td>
                                        <td class="p-2">{{ a.description }}</td>
                                        <td class="p-2">{{ a.system_prompt }}</td>
                                        <td class="p-2">{{ a.category.title }}</td>
                                        <td class="p-2">{{ a.subcategory }}</td>
                                        <td class="p-2">
                                            <Link as="button" class="text-sm text-purple-400 hover:text-purple-700 mx-2" :href="route('author.edit', a.id)">Editar</Link>
                                            <button class="text-sm text-red-400 hover:text-red-700 mx-2"
                                                    @click="confirmDeleteActive = true; deleteAuthorRow = a.id;">Eliminar</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <pagination :links="authors"/>
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
    import { Link, router } from '@inertiajs/vue3';

    import AppLayout from "@/Layouts/AppLayout.vue";
    import Pagination from '@/Shared/Pagination.vue';
    import ConfirmationModal from "@/Components/ConfirmationModal.vue";
    
    export default {
        props: {
            authors: Object,
            categories: Object,
            filter_category_id: String,
        },
        data(props) {
            return {
                confirmDeleteActive: false,
                deleteAuthorRow: "",
                category_id: props.filter_category_id,
            }
        }, 
        methods: {
            deleteAuthor() {
                router.delete(route("author.destroy", this.deleteAuthorRow));
                this.confirmDeleteActive = false;
            }, 
            customSearch() {
                router.get(route('author.index'),{
                    category_id: this.category_id,
                }, {
                    preserveState: true,
                    preserveScroll: true
                });
            },
        },
        components: {
            Link,
            AppLayout,
            Pagination,
            ConfirmationModal
        }
    }
</script>