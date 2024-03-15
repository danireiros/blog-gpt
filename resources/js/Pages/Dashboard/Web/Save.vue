<template>
    <AppLayout>
        <FormSection @submitted="submit" class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <template #title>
                <span v-if="form.id == ''">Crear </span>
                <span v-else>Actualizar </span>web
            </template>
            <template #description>
                <span>webes de los posts.</span>
            </template>
            <template #form>
                <div class="col-span-6">
                    <InputLabel for="">Nombre</InputLabel>
                    <InputError :message="errors.name"/>
                    <TextInput class="w-full" type="text" v-model="form.name"/>
                </div>
                <div v-if="web.image" class="col-span-6">
                    <InputLabel for="">Imagen actual</InputLabel>
                    <div class="max-w-64 rounded-md border p-1 my-2">
                        <img :src="'/image/web/'+web.image">
                        <a :href="'/image/web/'+web.image" download="" class="hover:text-white inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 mt-1">Descargar</a>
                    </div>
                </div>
                <div class="col-span-6">
                    <div>
                        <InputLabel for="image">Imagen</InputLabel>
                        <InputError :message="errors.image"/>
                        <TextInput class="w-full rounded-none" type="file" @input="form.image = $event.target.files[0]" />
                    </div>
                </div>
                <div class="col-span-6 no-tailwindcss-base">
                    <InputLabel for="">Descripción</InputLabel>
                    <InputError :message="errors.description" />
                    <textarea rows="4" placeholder="Descripcion publica del web aquí..." class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" v-model="form.description"></textarea>                                      
                </div>
                <div class="col-span-6">
                    <InputLabel for="">Categoría</InputLabel>
                    <InputError :message="errors.category_id"/>

                    <select class="rounded-md w-full border-gray-300" v-model="form.category_id">
                        <option v-for="c in categories" :key="c.id" :value="c.id" :selected="web.category_id === c.id">
                            {{ c.title }}
                        </option>
                    </select>
                </div>
                <div class="col-span-6">
                    <InputLabel for="">Dominio</InputLabel>
                    <InputError :message="errors.domain"/>
                    <TextInput class="w-full" type="text" v-model="form.domain"/>
                </div>
                <div class="col-span-6">
                    <InputLabel for="">Subdominio noticias</InputLabel>
                    <InputError :message="errors.news_subdomain"/>
                    <TextInput class="w-full" type="text" v-model="form.news_subdomain"/>
                </div>
                <div class="col-span-6">
                    <InputLabel for="">Inicio html noticias</InputLabel>
                    <InputError :message="errors.news_container_content_start"/>
                    <TextInput class="w-full" type="text" v-model="form.news_container_content_start"/>
                </div>
                <div class="col-span-6">
                    <InputLabel for="">Fin html noticias</InputLabel>
                    <InputError :message="errors.news_container_content_end"/>
                    <TextInput class="w-full" type="text" v-model="form.news_container_content_end"/>
                </div>
            </template>
            <template #actions>
                <PrimaryButton class="mt-1" type="submit">
                    <span v-if="form.id == ''">Añadir</span>
                    <span v-else>Actualizar web</span>
                </PrimaryButton>
            </template>
        </FormSection>

        <!-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mt-5">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">Gestion</h2>
                    </div>
                </div>
            </div>
        </div> -->

    </AppLayout>
</template>
<script>
import { useForm, router } from "@inertiajs/vue3";

import { Link } from "@inertiajs/vue3";
import AppLayout from '@/Layouts/AppLayout.vue';
import FormSection from '@/Components/FormSection.vue';
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

export default {
    components: {
        Link,
        AppLayout,
        FormSection,
        InputLabel,
        TextInput,
        InputError,
        PrimaryButton,
    },
    props:{
        errors: Object,
        web: {
            type: Object,
            default: {
                id: "",
                name: "",
                image: "",
                description: "",
                domain: "",
                news_subdomain: "",
                news_container_content_start: "",
                news_container_content_end: "",
                category_id: "",
            }
        },
        categories: Object,
    },
    setup(props) {
        const form = useForm({
            id: props.web.id,
            name: props.web.name,
            description: props.web.description,
            domain: props.web.domain,
            news_subdomain: props.web.news_subdomain,
            news_container_content_start: props.web.news_container_content_start,
            news_container_content_end: props.web.news_container_content_end,
            category_id: props.web.category_id,
            image: '',
        })

        function submit(){
            if(form.id == ""){
                router.post(route('web.store', form.id), {
                    name: form.name,
                    description: form.description,
                    domain: form.domain,
                    image: form.image,
                    news_subdomain: form.news_subdomain,
                    news_container_content_start: form.news_container_content_start,
                    news_container_content_end: form.news_container_content_end,
                    category_id: form.category_id,
                });
            }else{
                router.post(route('web.update', form.id), {
                    _method: 'put',
                    name: form.name,
                    description: form.description,
                    domain: form.domain,
                    image: form.image,
                    news_subdomain: form.news_subdomain,
                    news_container_content_start: form.news_container_content_start,
                    news_container_content_end: form.news_container_content_end,
                    category_id: form.category_id,
                });
            }
        }

        return { form, submit }
    },
}
</script>