<template>
    <!-- <AuthorLayout> -->
        <FormSection @submitted="submit" class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <template #title>
                <span v-if="form.id == ''">Crear </span>
                <span v-else>Actualizar </span>autor
            </template>
            <template #description>
                <span v-if="form.id == ''">Crear </span>
                <span v-else>Actualizar </span>un autor para una entrada del Blog
            </template>
            <template #form>
                <div class="col-span-6">
                    <InputLabel for="">Nombre</InputLabel>
                    <InputError :message="errors.name"/>
                    <TextInput class="w-full" type="text" v-model="form.name"/>
                </div> 

                <div class="col-span-6 no-tailwindcss-base">
                    <InputLabel for="">Descripción</InputLabel>
                    <InputError :message="errors.description" />

                    <ckeditor :editor="editor" v-model="form.description" :config="editorConfig"></ckeditor>
                </div>

                <div class="col-span-6">
                    <InputLabel for="">Tipo</InputLabel>
                    <InputError :message="errors.type"/>

                    <div v-for="value in enumType" :key="value" :value="value">
                        <input type="radio" :id="value" :name="value" :value="value" v-model="form.type">
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
    <!-- </AuthorLayout> -->
</template>

<script>
import { Link, useForm, router } from "@inertiajs/vue3";

/* import AuthorLayout from "@/Layouts/AuthorLayout.vue"; */
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
        /* AuthorLayout, */
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
        authorGeneral: {
            type: Object,
            default: {
                id: "",
                name: "",
                description: "",
                type: "",
            }
        },
        enumType: Array,
    },
    setup(props) {
        const form = useForm({
            id: props.authorGeneral.id,
            name: props.authorGeneral.name,
            description: props.authorGeneral.description,
            type: props.authorGeneral.type,
        })

        const formImage = ref([]);

        function submit(){
            if(form.id == ""){
                router.post(route('author-general.store', form.id), {
                    name: form.name,
                    description: form.description,
                    type: form.type,
                });
            }else
                router.post(route('author-general.update', form.id), {
                    _method: 'put',
                    name: form.name,
                    description: form.description,
                    type: form.type,
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