<template>
    <confirmation-modal :show="confirmDeleteTextActive">
        <template v-slot:title> Confirme la acción </template>

        <template v-slot:content>
            <p>¿Seguro que quieres eliminar el modelo de texto?</p>
        </template>

        <template v-slot:footer>
            <o-button variant="danger" @click="deleteText">Eliminar</o-button>
            <div class="mr-3"></div>
            <o-button @click="confirmDeleteTextActive = false">Cancelar</o-button>
        </template>
    </confirmation-modal>
    <confirmation-modal :show="confirmDeleteImageActive">
        <template v-slot:title> Confirme la acción </template>

        <template v-slot:content>
            <p>¿Seguro que quieres eliminar el modelo de imagen?</p>
        </template>

        <template v-slot:footer>
            <o-button variant="danger" @click="deleteImage">Eliminar</o-button>
            <div class="mr-3"></div>
            <o-button @click="confirmDeleteImageActive = false">Cancelar</o-button>
        </template>
    </confirmation-modal>

    <AppLayout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mt-5">
                <div class="card mb-5">
                    <div class="card-body">
                        <h2 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">Modelos activos</h2>
                        <div class="col-span-6">
                            <h2 class="font-semibold text-gray-900 dark:text-white">Texto</h2>
                            <h2 class="mb-2 text-3xl font-semibold text-purple-700 dark:text-white">{{ usedTextModel }}</h2>
                        </div>
                        <div class="col-span-6">
                            <h2 class="font-semibold text-gray-900 dark:text-white">Imagen</h2>
                            <h2 class="mb-2 text-3xl font-semibold text-orange-700 dark:text-white">{{ usedImageModel }}</h2>
                        </div>
                    </div>
                </div>
                <div class="card mb-5">
                    <div class="card-body">
                        <h2 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">Configuración</h2>
                        <div class="col-span-6">
                            <h2 class="mb-2 font-semibold text-gray-900 dark:text-white">Cambiar modelo de texto</h2>
                            
                            <select class="rounded-md w-full border-gray-300" v-model="defaultTextModel" @change="handleTextSelectionChange">
                                <option v-for="utm in textModels" :key="utm.id" :value="utm.id">
                                    {{ utm.name }} - {{ utm.model_name }}
                                </option>
                            </select>
                        </div>
                        <div class="col-span-6">
                            <h2 class="mb-2 font-semibold text-gray-900 dark:text-white">Cambiar modelo de imagen</h2>
                            <select class="rounded-md w-full border-gray-300" v-model="defaultImageModel" @change="handleImageSelectionChange">
                                <option v-for="uim in imageModels" :key="uim.id" :value="uim.id">
                                    {{ uim.name }} - {{ uim.model_name }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card mb-5">
                    <div class="card-body">
                        <h2 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">Modelos de texto</h2>
                        <Link class="link-button-default mb-3 hover:text-gray-100" :href="route('text.create')">Añadir modelo de texto</Link>
                            
                        <div v-if="textModels.length > 0" class="mb-8">
                            <table class="w-full border mb-5">
                                <thead class="bg-gray-200">
                                    <tr class="border-b">
                                        <th class="p-3">Nombre</th>
                                        <th class="p-3">Modelo</th>
                                        <th class="p-3">Temperatura</th>
                                        <th class="p-3">Tokens máximos</th>
                                        <th class="p-3">Top p</th>
                                        <th class="p-3">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b" v-for="tm in textModels" :key="tm.id" :class="tm.using ? 'bg-green-100' : ''">
                                        <td class="p-2">{{ tm.name }}</td>
                                        <td class="p-2 font-bold">{{ tm.model_name }}</td>
                                        <td class="p-2">{{ tm.temperature }}</td>
                                        <td class="p-2">{{ tm.max_tokens }}</td>
                                        <td class="p-2">{{ tm.top_p }}</td>
                                        <td class="p-2">
                                            <Link as="button" class="text-sm text-purple-400 hover:text-purple-700 mx-2" :href="route('text.edit', tm.id)">Editar</Link>
                                            <button class="text-sm text-red-400 hover:text-red-700 mx-2"
                                                    @click="confirmDeleteTextActive = true; deleteTextRow = tm.id;">Eliminar</button>
                                            
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div v-else>
                            <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
                                <p>No hay modelos de texto</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-5">
                    <div class="card-body">
                        <h2 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">Modelos de imagen</h2>
                        <Link class="link-button-default mb-3 hover:text-gray-100" :href="route('image.create')">Añadir modelo de imagen</Link>
                            
                        <div v-if="imageModels.length > 0" class="mb-8">
                            <table class="w-full border mb-5">
                                <thead class="bg-gray-200">
                                    <tr class="border-b">
                                        <th class="p-3">Nombre</th>
                                        <th class="p-3">Modelo</th>
                                        <th class="p-3">Tamaño de imagenes</th>
                                        <th class="p-3">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b" v-for="im in imageModels" :key="im.id" :class="im.using ? 'bg-green-100' : ''">
                                        <td class="p-2">{{ im.name }}</td>
                                        <td class="p-2 font-bold">{{ im.model_name }}</td>
                                        <td class="p-2">{{ im.size }}</td>
                                        <td class="p-2">
                                            <Link as="button" class="text-sm text-purple-400 hover:text-purple-700 mx-2" :href="route('image.edit', im.id)">Editar</Link>
                                            <button class="text-sm text-red-400 hover:text-red-700 mx-2"
                                                    @click="confirmDeleteImageActive = true; deleteImageRow = im.id;">Eliminar</button>
                                            
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div v-else>
                            <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
                                <p>No hay modelos de imagen</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-5">
                    <div class="card-body">
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

                        <h2 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">Pruebas</h2>
                        <Link class="link-button-default mb-3 hover:text-gray-100" :href="route('openai.post.random')">Redactar noticia aleatoria</Link>
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
    components: {
        Link,
        AppLayout,
        Pagination,
        ConfirmationModal
    },
    props: {
        imageModels: Object,
        textModels: Object,
        usedTextModel: Number,
        usedImageModel: Number,
    },
    data(props) {
        return {
            confirmDeleteTextActive: false,
            confirmDeleteImageActive: false,
            deleteTextRow: "",
            defaultTextModel: "",
            defaultImageModel: "",
        }
    },
    methods: {
        deleteText() {
            router.delete(route("text.destroy", this.deleteTextRow));
            this.confirmDeleteTextActive = false;
        }, 
        deleteImage() {
            router.delete(route("image.destroy", this.deleteImageRow));
            this.confirmDeleteImageActive = false;
        }, 
        handleTextSelectionChange() {
            this.setTextModel(this.defaultTextModel);
        },
        handleImageSelectionChange() {
            this.setImageModel(this.defaultImageModel);
        },
        setTextModel(defaultTextModel){
            router.post(route("text.model.default", defaultTextModel));
        },
        setImageModel(defaultImageModel){
            router.post(route("image.model.default", defaultImageModel));
        },
    },
    
}
</script>