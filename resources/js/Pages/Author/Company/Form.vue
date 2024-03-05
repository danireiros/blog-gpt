<template>
    <AppLayout>
        <FormSection @submitted="submit" class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <template #title>
                <span v-if="form.id == ''">Crear </span>
                <span v-else>Actualizar </span> compañia
            </template>
            <template #description>
                <span v-if="form.id == ''">Crear </span>
                <span v-else>Actualizar </span>un compañia de autor
            </template>
            <template #form>
                <div class="col-span-6">
                    <InputLabel for="">CIF</InputLabel>
                    <InputError :message="errors.CIF"/>
                    <TextInput class="w-full" type="text" v-model="form.CIF"/>
                </div> 

                <div class="col-span-6">
                    <InputLabel for="">Email</InputLabel>
                    <InputError :message="errors.email"/>
                    <TextInput class="w-full" type="text" v-model="form.email"/>
                </div> 

                <div class="col-span-6">
                    <InputLabel for="">Autor general</InputLabel>
                    <InputError :message="errors.author_general_id"/>

                    <select class="rounded-md w-full border-gray-300" v-model="form.author_general_id">
                        <option v-for="ag in authors" :key="ag.id" :value="ag.id" :selected="authorCompany.author_general_id === ag.id">
                            {{ ag.name }}
                        </option>
                    </select>
                </div>

                <div class="col-span-6">
                    <InputLabel for="">Extra</InputLabel>
                    <InputError :message="errors.extra"/>
                    <TextInput class="w-full" type="text" v-model="form.extra"/>
                </div> 

                <div class="col-span-6">
                    <InputLabel for="">Tipo</InputLabel>
                    <InputError :message="errors.choices"/>

                    <div v-for="value in enumChoices" :key="value" :value="value">
                        <input type="radio" :id="value" :name="value" :value="value" v-model="form.choices">
                        <label :for="value" class="ml-3">{{ value }}</label><br>
                    </div>
                </div>
            </template>
            <template #actions>
                <PrimaryButton class="mt-1" type="submit">
                    <span v-if="form.id == ''">Siguiente <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                    </span>
                    <span v-else>Actualizar Autor</span>
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
        authorCompany: {
            type: Object,
            default: {
                id: "",
                CIF: "",
                email: "",
                extra: "",
                image: "",
                author_general_id: "",
                choices: "",
            }
        },
        authors: Object,
        enumChoices: Array,
    },
    setup(props) {
        const form = useForm({
            id: props.authorCompany.id,
            CIF: props.authorCompany.CIF,
            email: props.authorCompany.email,
            extra: props.authorCompany.extra,
            image: props.authorCompany.image,
            author_general_id: props.authorCompany.author_general_id,
            choices: props.authorCompany.choices,
        })

        const formImage = ref([]);

        function submit(){
            if(form.id == ""){
                router.post(route('author-company.store', form.id), {
                    name: form.name,
                    CIF: form.CIF,
                    email: form.email,
                    extra: form.extra,
                    image: form.image,
                    author_general_id: form.author_general_id,
                    choices: form.choices,
                });
            }else
                router.post(route('author-company.update', form.id), {
                    _method: 'put',
                    name: form.name,
                    CIF: form.CIF,
                    email: form.email,
                    extra: form.extra,
                    image: form.image,
                    author_general_id: form.author_general_id,
                    choices: form.choices,
                });
        }

        return { form, submit }
    },
}
</script>