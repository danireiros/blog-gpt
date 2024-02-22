<template>
    <AppLayout>
        <FormSection @submitted="submit" class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <template #title>
                Actualizar Categoría
            </template>
            <template #description>
                Actualizar una categoría para los posts
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
            </template>
            <template #actions>
                <PrimaryButton class="mt-1" type="submit">
                    Actualizar categoría
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
        category: Object,
    },
    setup(props) {
        const form = useForm({
            id: props.category.id,
            title: props.category.title,
            slug: props.category.slug,
        })

        function submit(){
            form.put(route('category.update', form.id), form);
        }

        return { form, submit }
    },
}
</script>