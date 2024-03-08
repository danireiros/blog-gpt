<template>
    <AppLayout>
        <FormSection @submitted="submit" class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <template #title>
                <span v-if="form.id == ''">Crear </span>
                <span v-else>Actualizar </span>autor
            </template>
            <template #description>
                <span>Autores de los posts.</span>
            </template>
            <template #form>
                <div class="col-span-6">
                    <InputLabel for="">Nombre</InputLabel>
                    <InputError :message="errors.name"/>
                    <TextInput class="w-full" type="text" v-model="form.name"/>
                </div>

                <div v-if="author.image" class="col-span-6">
                    <InputLabel for="">Imagen actual</InputLabel>
                    <div class="max-w-64 rounded-md border p-1 my-2">
                        <img :src="'/image/author/'+author.image">
                        <a :href="'/image/author/'+author.image" download="" class="hover:text-white inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 mt-1">Descargar</a>
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
                    <textarea rows="4" placeholder="Descripcion publica del autor aquí..." class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" v-model="form.description"></textarea>                                      
                </div>

                <div class="col-span-6 no-tailwindcss-base">
                    <InputLabel for="">Prompt para OpenAi</InputLabel>
                    <InputError :message="errors.system_prompt" />
                    <textarea rows="4" placeholder="Prompt del autor aquí..." class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" v-model="form.system_prompt"></textarea>                                      
                </div>

                <div class="col-span-6">
                    <InputLabel for="">Categoría</InputLabel>
                    <InputError :message="errors.category_id"/>

                    <select class="rounded-md w-full border-gray-300" v-model="form.category_id">
                        <option v-for="c in categories" :key="c.id" :value="c.id" :selected="author.category_id === c.id">
                            {{ c.title }}
                        </option>
                    </select>
                </div>

                <div class="col-span-6">
                    <InputLabel for="">Subcategoría</InputLabel>
                    <InputError :message="errors.subcategory"/>
                    <TextInput class="w-full" type="text" v-model="form.subcategory"/>
                </div>

                <!-- <div class="col-span-6">
                    <InputLabel for="">Tipo</InputLabel>
                    <InputError :message="errors.type"/>

                    <div v-for="value in enumType" :key="value" :value="value">
                        <input type="radio" :id="value" :name="value" :value="value" v-model="form.type">
                        <label :for="value" class="ml-3">{{ value }}</label><br>
                    </div>
                </div> -->
            </template>
            <template #actions>
                <PrimaryButton class="mt-1" type="submit">
                    <span v-if="form.id == ''">Crear</span>
                    <span v-else>Actualizar autor</span>
                </PrimaryButton>
            </template>
        </FormSection>
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
        author: {
            type: Object,
            default: {
                id: "",
                name: "",
                image: "",
                description: "",
                system_prompt: "",
                /* type: "", */
                category_id: "",
                subcategory: "",
            }
        },
        categories: Object,
        /* enumType: Array, */
    },
    setup(props) {
        const form = useForm({
            id: props.author.id,
            name: props.author.name,
            description: props.author.description,
            system_prompt: props.author.system_prompt,
            category_id: props.author.category_id,
            subcategory: props.author.subcategory,
            /* type: props.author.type, */
            image: ''
        })

        function submit(){
            if(form.id == ""){
                router.post(route('author.store', form.id), {
                    name: form.name,
                    /* type: form.type, */
                    description: form.description,
                    system_prompt: form.system_prompt,
                    image: form.image,
                    category_id: form.category_id,
                    subcategory: form.subcategory,
                });
            }else{
                router.post(route('author.update', form.id), {
                    _method: 'put',
                    name: form.name,
                    /* type: form.type, */
                    description: form.description,
                    system_prompt: form.system_prompt,
                    image: form.image,
                    category_id: form.category_id,
                    subcategory: form.subcategory,
                });
            }
        }

        return { form, submit }
    },
}
</script>