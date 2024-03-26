<template>
    <AppLayout>
        <FormSection @submitted="submit" class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <template #title>
                <span v-if="form.id == ''">Crear </span>
                <span v-else>Actualizar </span>modelo de imagen
            </template>
            <template #description>
                <span>Modelos de imagen de OpenAi.</span>
            </template>
            <template #form>
                <div class="col-span-6">
                    <InputLabel for="">Nombre</InputLabel>
                    <InputError :message="errors.name"/>
                    <TextInput class="w-full" type="text" v-model="form.name"/>
                </div>
                <div class="col-span-6">
                    <InputLabel for="">Nombre del modelo de openAi</InputLabel>
                    <InputError :message="errors.model_name"/>
                    <TextInput class="w-full" type="text" v-model="form.model_name"/>
                </div>
                <div class="col-span-6">
                    <InputLabel for="">Tamaño de las imagenes</InputLabel>
                    <InputError :message="errors.size"/>
                    <TextInput class="w-full" type="text" v-model="form.size"/>
                </div>
            </template>
            <template #actions>
                <PrimaryButton class="mt-1" type="submit">
                    <span v-if="form.id == ''">Crear</span>
                    <span v-else>Actualizar modelo de texto</span>
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
        model: {
            type: Object,
            default: {
                id: "",
                name: "",
                model_name: "",
                size: "",
                using: "",
            }
        },
        categories: Object,
    },
    setup(props) {
        const form = useForm({
            id: props.model.id,
            name: props.model.name,
            model_name: props.model.model_name,
            size: props.model.size,
            using: props.model.using,
        })

        function submit(){
            if(form.id == ""){
                router.post(route('image.store', form.id), {
                    name: form.name,
                    model_name: form.model_name,
                    size: form.size,
                    using: form.using,
                });
            }else{
                router.post(route('image.update', form.id), {
                    _method: 'put',
                    name: form.name,
                    model_name: form.model_name,
                    size: form.size,
                    using: form.using,
                });
            }
        }

        return { form, submit }
    },
}
</script>