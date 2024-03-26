<template>
    <AppLayout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mt-5">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">Webs</h2>
                        <Link class="link-button-default mb-3 hover:text-gray-100" :href="route('web.create')">Añadir web</Link>
                        <div v-if="webs.data.length > 0">
                            <table class="w-full border">
                                <thead class="bg-gray-200">
                                    <tr class="border-b">
                                        <th class="p-3">Imagen</th>
                                        <th class="p-3">Nombre</th>
                                        <!-- <th class="p-3">Descripcion</th> -->
                                        <th class="p-3">Dominio</th>
                                        <!-- <th class="p-3">Subdominio</th> -->
                                        <th class="p-3">Categoria</th>
                                        <th class="p-3">Estilo Imagen</th>
                                        <th class="p-3">#</th>
                                        <th class="p-3">Noticias</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b" v-for="w in webs.data" :key="w.id">
                                        <td class="p-2">
                                            <img class="h-16 w-16" :src="'/image/web/'+w.image">
                                        </td>
                                        <td class="p-2 font-bold">{{ w.name }}</td>
                                        <!-- <td class="p-2">{{ w.description }}</td> -->
                                        <td class="p-2">{{ w.domain }}</td>
                                        <!-- <td class="p-2">{{ w.news_subdomain }}</td> -->
                                        <td class="p-2">{{ w.category.title }}</td>
                                        <td class="p-2">{{ w.style }}</td>
                                        <td class="p-2">
                                            <Link as="button" class="text-sm text-purple-400 hover:text-purple-700 mx-2" :href="route('web.edit', w.id)">Editar</Link>
                                            <button class="text-sm text-red-400 hover:text-red-700 mx-2"
                                                    @click="confirmDeleteActive = true; deleteWebRow = a.id;">Eliminar</button>
                                            
                                        </td>
                                        <td class="p-2">
                                            <Link as="button" class="link-button-default mb-3 hover:text-gray-100" :href="route('web.generate', w.name)">Generar noticias</Link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <pagination :links="webs"/>
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
    data() {
        return {
            confirmDeleteActive: false,
            deleteWebRow: "",
        }
    }, 
    methods: {
        deleteWeb() {
            router.delete(route("web.destroy", this.deleteWebRow));
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
        webs: Object,
    }
}
</script>