<template>

    <confirmation-modal :show="confirmDeleteActive">
        <template v-slot:title> Confirme la acción </template>

        <template v-slot:content>
            <p>¿Seguro que quieres eliminar la web?</p>
        </template>

        <template v-slot:footer>
            <o-button variant="danger" @click="deleteWeb">Eliminar</o-button>
            <div class="mr-3"></div>
            <o-button @click="confirmDeleteActive = false">Cancelar</o-button>
        </template>
    </confirmation-modal>

    <AppLayout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mt-5">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">Webs</h2>
                        <Link class="link-button-default mb-3 hover:text-gray-100" :href="route('web.create')">Añadir web</Link>
                        <div v-if="webs.length > 0">
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
                                    <tr class="border-b" v-for="w in webs" :key="w.id">
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
                                                    @click="confirmDeleteActive = true; deleteWebRow = w.id;">Eliminar</button>

                                        </td>
                                        <td class="p-2">
                                            <Link as="button" class="link-button-default mb-3 hover:text-gray-100" :href="route('web.generate', w.name)">Obtener ultimos links</Link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- <pagination :links="webs"/> -->
                        </div>
                        <div v-else>
                            <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
                                <p>No hay webs</p>
                            </div>
                        </div>

                        <div v-if="webLinks.data.length > 0" class="mt-8">
                            <h2 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">Links de noticias</h2>
                            <div class="my-4">
                                <button class="text-sm text-red-400 hover:text-red-700" @click="deleteWebLinks()">Limpiar links</button>
                            </div>
                            <table class="w-full border">
                                <thead class="bg-gray-200">
                                    <tr class="border-b">
                                        <th class="p-3">Web</th>
                                        <th class="p-3">Link</th>
                                        <th class="p-3">Estado</th>
                                        <th class="p-3">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b" v-for="w in webLinks.data" :key="w.id">
                                        <td class="p-2 font-bold">{{ w.web.name }}</td>
                                        <td class="p-2">{{ w.link }}</td>
                                        <td class="p-2">
                                            <div v-if="w.status == 'Usado'">
                                                <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                                    {{ w.status }}
                                                </span>
                                            </div>
                                            <div v-else-if="w.status == 'Pendiente'">
                                                <span class="bg-orange-100 text-orange-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-orange-900 dark:text-orange-300">
                                                    {{ w.status }}
                                                </span>
                                            </div>
                                            <div v-else>
                                                <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                                                    {{ w.status }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="p-2">
                                            <Link as="button" class="link-button-default hover:text-gray-100" :href="route('web.link.generate', w.id)">Generar noticia</Link>
                                            <!-- <Link as="button" class="text-sm text-red-400 hover:text-red-700 mx-2" method="delete" :href="route('weblink.destroy', w.id)">Eliminar</Link>
                                            <button class="text-sm text-red-400 hover:text-red-700 mx-2" @click="deleteWebLink(w.id)">Eliminar</button>
                                         --></td>
                                    </tr>
                                </tbody>
                            </table>

                            <pagination :links="webLinks"/>
                        </div>
                        <div v-else class="mt-8">
                            <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
                                <p>No hay links</p>
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
            router.delete(route("web.destroy", this.deleteWebRow , {
                preserveState: true,
                preserveScroll: true
            }));
            this.confirmDeleteActive = false;
        },
        deleteWebLinks() {
            router.delete(route("weblink.remove", {
                preserveState: true,
                preserveScroll: true
            }));
        }
    },
    components: {
        Link,
        AppLayout,
        Pagination,
        ConfirmationModal
    },
    props: {
        webs: Object,
        webLinks: Object,
    }
}
</script>
