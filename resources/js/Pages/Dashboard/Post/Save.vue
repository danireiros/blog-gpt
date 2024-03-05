<template>
    <AppLayout>
        <FormSection @submitted="submit" class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <template #title>
                <span v-if="form.id == ''">Crear </span>
                <span v-else>Actualizar </span>post
            </template>
            <template #description>
                <span v-if="form.id == ''">Crear </span>
                <span v-else>Actualizar </span>un post para el blog
            </template>
            <template #form>
                <div v-if="post.image" class="col-span-6">
                    <InputLabel for="">Imagen actual</InputLabel>
                    <div class="max-w-64 rounded-md border p-1 my-2">
                        <img :src="'/image/post/'+post.image">
                        <a :href="'/image/post/'+post.image" download="" class="hover:text-white inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 mt-1">Descargar</a>
                    </div>
                </div>
                <div class="col-span-6">
                    <InputLabel for="">Titulo</InputLabel>
                    <InputError :message="errors.title"/>
                    <TextInput class="w-full" type="text" v-model="form.title"/>
                </div> 
                
                <div class="col-span-6">
                    <InputLabel for="">Slug</InputLabel>
                    <InputError :message="errors.slug"/>
                    <TextInput class="w-full" type="text" v-model="form.slug"/>
                </div>

                <div class="col-span-6">
                    <InputLabel for="">Categoría</InputLabel>
                    <InputError :message="errors.category_id"/>

                    <select class="rounded-md w-full border-gray-300" v-model="form.category_id">
                        <option v-for="c in categories" :key="c.id" :value="c.id" :selected="post.category_id === c.id">
                            {{ c.title }}
                        </option>
                    </select>
                </div>

                <div class="col-span-6 no-tailwindcss-base">
                    <InputLabel value="Text" />
                    <InputError :message="errors.text" />
                    <!-- <textarea rows="4" placeholder="Contenido del post aquí..." class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" v-model="form.text"></textarea>                   
                     -->
                     <ckeditor :editor="editor" v-model="form.text" :config="editorConfig"></ckeditor>
                </div>

                <div class="col-span-6">
                    <InputLabel for="">Descripción</InputLabel>
                    <InputError :message="errors.description"/>
                    <TextInput class="w-full" type="text" v-model="form.description"/>
                </div> 

                <div class="col-span-6">
                    <InputLabel for="">Publicado</InputLabel>
                    <InputError :message="errors.posted"/>

                    <div v-for="value in enumPosted" :key="value" :value="value">
                        <input type="radio" :id="value" :name="value" :value="value" v-model="form.posted">
                        <label :for="value" class="ml-3">{{ value }}</label><br>
                    </div>
                </div>

                <div class="col-span-6">
                    <InputLabel for="">Tipo</InputLabel>
                    <InputError :message="errors.type"/>

                    <div v-for="value in enumType" :key="value" :value="value">
                        <input type="radio" :id="value" :name="value" :value="value" v-model="form.type">
                        <label :for="value" class="ml-3">{{ value }}</label><br>
                    </div>
                </div>

                <div class="col-span-6" v-if="form.id != ''">
                    <!-- <div>
                        <InputLabel for="image">Imagen</InputLabel>
                        <InputError :message="errors.image"/>
                        <TextInput class="w-full rounded-none" type="file" @input="form.image = $event.target.files[0]" />
                    </div> -->

                    <!-- Subida de fichero normal -->
                    <InputLabel for="">Imagen</InputLabel>
                    <InputError :message="errors.image"/>
                    <section>
                        <o-field class="file">
                            <o-upload v-slot="{ onclick }" v-model="form.image">
                                <o-button tag="button" variant="primary" @click="onclick">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15m0-3-3-3m0 0-3 3m3-3V15" />
                                        </svg>
                                    Selecciona una imagen</span>
                                </o-button>
                            </o-upload>
                            <span v-if="form.image.name != ''" class="border p-1 pl-5">
                            {{ form.image.name }} <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                            </svg>
                        </span>
                        </o-field>
                    </section>

                    <!-- <section>
                        <o-field class="file">
                            <o-upload v-slot="{ onclick }" v-model="formImage" drag-drop>
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15m0-3-3-3m0 0-3 3m3-3V15" />
                                    </svg>
                                    Arrastra una imagen
                                </span>
                                <o-button tag="button" variant="primary">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15m0-3-3-3m0 0-3 3m3-3V15" />
                                        </svg>
                                        Arrastra una imagen</span>
                                </o-button>
                                <span v-if="form.image != ''">
                                    Imagen cargada <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                                    </svg>
                                </span>
                            </o-upload>
                        </o-field>
                    </section> -->
                </div>

            </template>
            <template #actions>
                <PrimaryButton class="mt-1" type="submit">
                    <span v-if="form.id == ''">Siguiente <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                    </span>
                    <span v-else>Actualizar post</span>
                </PrimaryButton>
            </template>
        </FormSection>

    </AppLayout>
</template>

<script>
import { Link, useForm, router } from "@inertiajs/vue3";

import AppLayout from "@/Layouts/AppLayout.vue";
import FormSection from "@/Components/FormSection.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { watch, ref } from "vue";

import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

const file = ref(null);

export default {
    components:{
        Link,
        AppLayout,
        FormSection,
        InputLabel,
        TextInput,
        InputError,
        PrimaryButton,
        ClassicEditor,
    },
    data() {
        return {
            editor: ClassicEditor,
            editorData: '<p>Content of the editor.</p>',
            editorConfig: {
                // The configuration of the editor.
            }
        };
    },
    props:{
        errors: Object,
        post: {
            type: Object,
            default: {
                id: "",
                title: "",
                slug: "",
                category_id: "",
                description: "",
                text: "",
                posted: "",
                type: "",
                image: "",
                formImage: "",
            }
        },
        categories: Object,
        enumPosted: Array,
        enumType: Array,
    },
    setup(props) {
        const form = useForm({
            id: props.post.id,
            title: props.post.title,
            slug: props.post.slug,
            category_id: props.post.category_id,
            description: props.post.description,
            text: props.post.text,
            posted: props.post.posted,
            type: props.post.type,
            image: ''
        })

        const formImage = ref([]);

        function submit(){
            if(form.id == ""){
                router.post(route('post.store', form.id), {
                    title: form.title,
                    slug: form.slug,
                    category_id: form.category_id,
                    description: form.description,
                    text: form.text,
                    posted: form.posted,
                    type: form.type,
                    image: form.image,
                });
            }else
                router.post(route('post.update', form.id), {
                    _method: 'put',
                    title: form.title,
                    slug: form.slug,
                    category_id: form.category_id,
                    description: form.description,
                    text: form.text,
                    posted: form.posted,
                    type: form.type,
                    image: form.image,
                });
        }

        /* watch(() => form.image, (value) => {
            console.log(value);
        },
            { deep: true }); */

        // Subir imagen al cargarla
        watch(() => formImage, (currentFile) => {
            /*
            router.post(route("post.upload", form.id), {
                image: currentFile.value
            }); */
        },
            { deep: true });

        return { form, formImage, submit }
    },
}
</script>