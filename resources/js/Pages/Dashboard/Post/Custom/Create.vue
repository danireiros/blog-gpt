<template>
    <AppLayout>
        <FormSection @submitted="submit" class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <template #title>
                Crear Post
            </template>
            <template #description>
                Crear una post nuevo con ayuda de IA para el blog
            </template>
            <template #form>
                <div class="col-span-6">
                    <InputLabel for="">Titulo</InputLabel>
                    <small class="text-gray-300">Opcional</small>
                    <InputError :message="errors.title"/>
                    <TextInput class="w-full" type="text" v-model="form.title"/>
                </div>
                <div class="col-span-6">
                    <InputLabel for="">Contenido</InputLabel>
                    <InputError :message="errors.content" />
                    <textarea rows="4" placeholder="Contenido del post aquí..." class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" v-model="form.content"></textarea>
                </div>
                <div class="col-span-6">
                    <InputLabel for="">Autor</InputLabel>
                    <InputError :message="errors.author_id"/>

                    <select class="rounded-md w-full border-gray-300" v-model="form.author_id">
                        <option v-for="a in authors" :key="a.id" :value="a.id">
                            {{ a.name }} - {{ a.category.title }}
                        </option>
                    </select>
                </div>
                <div class="col-span-6">
                    <InputLabel for="">Estilo de la imagen</InputLabel>
                    <InputError :message="errors.style"/>
                    <TextInput placeholder="Ej: Comic" class="w-full" type="text" v-model="form.style"/>
                </div>
            </template>
            <template #actions>
                <PrimaryButton class="mt-1" type="submit">
                    Generar post con ayuda de IA
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
        authors: Object,
    },
    setup() {
        const form = useForm({
            title: null,
            content: null,
            author: null,
            style: null,
        })

        function submit(){
            router.post(route('post.store.custom', form));
        }

        return { form, submit }
    },
}
</script>
