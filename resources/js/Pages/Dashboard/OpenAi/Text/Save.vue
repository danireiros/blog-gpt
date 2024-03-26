<template>
    <AppLayout>
        <FormSection @submitted="submit" class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <template #title>
                <span v-if="form.id == ''">Crear </span>
                <span v-else>Actualizar </span>modelo de chat/texto
            </template>
            <template #description>
                <span>Modelos de chat / texto de OpenAi.</span>
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
                    <InputLabel for="">Temperatura</InputLabel>
                    <InputError :message="errors.temperature"/>
                    <TextInput class="w-full" type="number" step="0.1" v-model="form.temperature"/>
                </div>
                <div class="col-span-6">
                    <InputLabel for="">Máximo de tokens</InputLabel>
                    <InputError :message="errors.max_tokens"/>
                    <TextInput class="w-full" type="number" step="64" v-model="form.max_tokens"/>
                </div>
                <div class="col-span-6">
                    <InputLabel for="">Top p</InputLabel>
                    <InputError :message="errors.top_p"/>
                    <TextInput class="w-full" type="number" step="1" v-model="form.top_p"/>
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
        text: {
            type: Object,
            default: {
                id: "",
                name: "",
                model_name: "",
                temperature: "",
                max_tokens: "",
                top_p: "",
                using: "",
            }
        },
        categories: Object,
    },
    setup(props) {
        const form = useForm({
            id: props.text.id,
            name: props.text.name,
            model_name: props.text.model_name,
            temperature: props.text.temperature,
            max_tokens: props.text.max_tokens,
            top_p: props.text.top_p,
            using: props.text.using,
        })

        function submit(){
            if(form.id == ""){
                router.post(route('text.store', form.id), {
                    name: form.name,
                    model_name: form.model_name,
                    temperature: form.temperature,
                    max_tokens: form.max_tokens,
                    top_p: form.top_p,
                    using: form.using,
                });
            }else{
                router.post(route('text.update', form.id), {
                    _method: 'put',
                    name: form.name,
                    model_name: form.model_name,
                    temperature: form.temperature,
                    max_tokens: form.max_tokens,
                    top_p: form.top_p,
                    using: form.using,
                });
            }
        }

        return { form, submit }
    },
}
</script>