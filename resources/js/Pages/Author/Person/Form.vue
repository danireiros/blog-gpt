<template>
    <AppLayout>
        <FormSection @submitted="submit" class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <template #title>
                <span v-if="form.id == ''">Crear </span>
                <span v-else>Actualizar </span> persona
            </template>
            <template #description>
                <span v-if="form.id == ''">Crear </span>
                <span v-else>Actualizar </span>un persona de autor
            </template>
            <template #form>
                <div class="col-span-6">
                    <InputLabel for="">Autor general</InputLabel>
                    <InputError :message="errors.author_general_id"/>

                    <select class="rounded-md w-full border-gray-300" v-model="form.author_general_id">
                        <option v-for="ag in authors" :key="ag.id" :value="ag.id" :selected="authorPerson.author_general_id === ag.id">
                            {{ ag.name }}
                        </option>
                    </select>
                </div>

                <div class="col-span-6">
                    <InputLabel for="">Username</InputLabel>
                    <InputError :message="errors.username"/>
                    <TextInput class="w-full" type="text" v-model="form.username"/>
                </div> 

                <div class="col-span-6">
                    <InputLabel for="">Tipo</InputLabel>
                    <InputError :message="errors.choices"/>

                    <div v-for="value in enumChoices" :key="value" :value="value">
                        <input type="radio" :id="value" :name="value" :value="value" v-model="form.choices">
                        <label :for="value" class="ml-3">{{ value }}</label><br>
                    </div>
                </div>

                <div class="col-span-6">
                    <InputLabel for="">Otros</InputLabel>
                    <InputError :message="errors.other"/>
                    <TextInput class="w-full" type="text" v-model="form.other"/>
                </div> 
            </template>
            <template #actions>
                <PrimaryButton class="mt-1" type="submit">
                    <span v-if="form.id == ''">Siguiente <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                    </span>
                    <span v-else>Actualizar persona</span>
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
        authorPerson: {
            type: Object,
            default: {
                id: "",
                other: "",
                username: "",
                author_general_id: "",
                choices: "",
            }
        },
        authors: Object,
        enumChoices: Array,
    },
    setup(props) {
        const form = useForm({
            id: props.authorPerson.id,
            other: props.authorPerson.other,
            username: props.authorPerson.username,
            author_general_id: props.authorPerson.author_general_id,
            choices: props.authorPerson.choices,
        })

        const formImage = ref([]);

        function submit(){
            if(form.id == ""){
                router.post(route('author-person.store', form.id), {
                    other: form.other,
                    username: form.username,
                    author_general_id: form.author_general_id,
                    choices: form.choices,
                });
            }else
                router.post(route('author-person.update', form.id), {
                    _method: 'put',
                    other: form.other,
                    username: form.username,
                    author_general_id: form.author_general_id,
                    choices: form.choices,
                });
        }

        return { form, submit }
    },
}
</script>