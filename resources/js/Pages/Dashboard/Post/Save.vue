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

                <div class="col-span-6">
                    <InputLabel value="Text" />
                    <InputError :message="errors.text" />
                    <textarea rows="4" placeholder="Contenido del post aquí..." class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" v-model="form.text"></textarea>                   
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
                        <input type="radio" id="enumPosted" name="enumPosted" :value="value" v-model="form.posted">
                        <label for="enumPosted" class="ml-3">{{ value }}</label><br>
                    </div>
                </div>

                <div class="col-span-6">
                    <InputLabel for="">Tipo</InputLabel>
                    <InputError :message="errors.type"/>

                    <div v-for="value in enumType" :key="value" :value="value">
                        <input type="radio" id="enumType" name="enumType" :value="value" v-model="form.type">
                        <label for="enumType" class="ml-3">{{ value }}</label><br>
                    </div>
                </div>
            </template>
            <template #actions>
                <PrimaryButton class="mt-1" type="submit">
                    <span v-if="form.id == ''">Crear post</span>
                    <span v-else>Actualizar post</span>
                </PrimaryButton>
            </template>
        </FormSection>
    </AppLayout>
</template>

<script>
import { useForm, router } from "@inertiajs/vue3";

import AppLayout from "@/Layouts/AppLayout.vue";
import FormSection from "@/Components/FormSection.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

export default {
    components:{
        AppLayout,
        FormSection,
        InputLabel,
        TextInput,
        InputError,
        PrimaryButton,
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
        })

        function submit(){
            if(form.id == "")
                router.post(route('post.store', form));
            else
                form.put(route('post.update', form.id), form);
        }

        return { form, submit }
    },
}
</script>