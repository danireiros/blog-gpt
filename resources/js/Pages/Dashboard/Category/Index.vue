<template>
    <confirmation-modal :show="confirmDeleteActive">
        <template v-slot:title> Confirme la acción </template>

        <template v-slot:content>
            <p>¿Seguro que quieres eliminar la categoría?</p>
        </template>

        <template v-slot:footer>
            <o-button variant="danger" @click="deleteCategory">Eliminar</o-button>
            <div class="mr-3"></div>
            <o-button @click="confirmDeleteActive = false">Cancelar</o-button>
        </template>
    </confirmation-modal>

    <AppLayout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mt-5">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">Categorias</h2>
                        <Link class="link-button-default mb-3 hover:text-gray-100" :href="route('category.create')">Crear</Link>
                        <div v-if="categories.data.length > 0">
                            <table class="w-full border">
                                <thead class="bg-gray-200">
                                    <tr class="border-b">
                                        <th class="p-3">ID</th>
                                        <th class="p-3">Titulo</th>
                                        <th class="p-3">Slug</th>
                                        <th class="p-3">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b" v-for="c in categories.data" :key="c.id">
                                        <td class="p-2">{{ c.id }}</td>
                                        <td class="p-2 font-bold">{{ c.title }}</td>
                                        <td class="p-2">{{ c.slug }}</td>
                                        <td class="p-2">
                                            <Link as="button" class="text-sm text-purple-400 hover:text-purple-700 mx-2" :href="route('category.edit', c.id)">Editar</Link>
                                            <!-- <Link as="button" class="text-sm text-red-400 hover:text-red-700 mx-2" method="delete" :href="route('category.destroy', c.id)">Eliminar</Link> -->
                                            <button class="text-sm text-red-400 hover:text-red-700 mx-2"
                                                    @click="confirmDeleteActive = true; deleteCategoryRow = c.id;">Eliminar</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <pagination :links="categories"/>
                        </div>
                        <div v-else>
                            <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
                                <p>No hay categorias</p>
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
        data() {
            return {
                confirmDeleteActive: false,
                deleteCategoryRow: "",
            }
        }, 
        methods: {
            deleteCategory() {
                router.delete(route("category.destroy", this.deleteCategoryRow));
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
            categories: Object,
        }
    }
</script>
