<template>
    <AppLayout>
        <FormSection @submitted="submit" class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <template #title>
                Crear Categoría
            </template>
            <template #description>
                Crear una categoría para los posts
            </template>
            <template #form>
                <div class="col-span-6">
                    <InputLabel for="">Titulo</InputLabel>
                    <InputError :message="errors.title"/>
                    <TextInput class="w-full" type="text" v-model="form.title"/>
                </div> 
                <div class="col-span-6">
                    <InputLabel for="">Color</InputLabel>
                    <InputError :message="errors.color"/>
                    <TextInput class="w-full" type="color" v-model="form.color"/>
                </div>
                <div class="col-span-6">
                    <InputLabel for="image">Imagen</InputLabel>
                    <InputError :message="errors.image"/>
                    <TextInput class="w-full rounded-none" type="file" @input="form.image = $event.target.files[0]" />
                </div>
                <div class="col-span-6">
                    <InputLabel for="">Slug</InputLabel>
                    <InputError :message="errors.slug"/>
                    <TextInput class="w-full" type="text" v-model="form.slug"/>
                </div>
            </template>
            <template #actions>
                <PrimaryButton class="mt-1" type="submit">
                    Crear categoría
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
        errors: Object
    },
    setup() {
        const form = useForm({
            title: null,
            slug: null,
            color: null,
            image: null,
        })

        function submit(){
            router.post(route('category.store', form.id), {
                title: form.title,
                slug: form.slug,
                color: form.color,
                image: form.image,
            });
        }

        return { form, submit }
    },
}
</script>