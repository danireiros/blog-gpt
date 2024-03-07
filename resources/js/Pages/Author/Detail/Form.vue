<template>
    <!-- <AppLayout> -->
        <FormSection @submitted="submit" class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <template #title>
                <span v-if="form.id == ''">Crear </span>
                <span v-else>Actualizar </span> detalle
            </template>
            <template #description>
                <span v-if="form.id == ''">Crear </span>
                <span v-else>Actualizar </span>un detalle de autor
            </template>
            <template #form>
                <div class="col-span-6">
                    <InputLabel for="">Autor general</InputLabel>
                    <InputError :message="errors.author_general_id"/>

                    <select class="rounded-md w-full border-gray-300" v-model="form.author_general_id" disabled="disabled" readonly>
                        <option v-for="ag in authors" :key="ag.id" :value="ag.id" :selected="generalId === ag.id">
                            {{ ag.name }}
                        </option>
                    </select>
                </div>

                <div class="col-span-6">
                    <InputLabel for="">Detalles</InputLabel>
                    <InputError :message="errors.details"/>
                    <TextInput class="w-full" type="text" v-model="form.details"/>
                </div> 

            </template>
            <template #actions>
                <span class="m-3 cursor-pointer hover:text-gray-500" @click="$emit('backStepEvent', backStep)">Atras</span>
                <PrimaryButton class="mt-1" type="submit">
                    <span v-if="form.id == ''">Siguiente <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                    </span>
                    <span v-else>Actualizar detalle</span>
                </PrimaryButton>
            </template>
        </FormSection>

   <!-- </AppLayout> -->
</template>

<script>
import { Link, useForm, router } from "@inertiajs/vue3";

/* import AppLayout from "@/Layouts/AppLayout.vue"; */
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
        /* AppLayout, */
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
        authorDetail: {
            type: Object,
            default: {
                id: "",
                author_general_id: "",
                details: "",
            }
        },
        authors: Object,
        generalId: {
            type: Number,
            default: {
                id: 0,
            }
        },
        backStep: {
            type: Number,
            default: {
                id: 2,
            }
        },
    },
    emits: ['backStepEvent'],
    setup(props) {
        const form = useForm({
            id: props.authorDetail.id,
            details: props.authorDetail.details,
            author_general_id: props.generalId,
        })

        const formImage = ref([]);

        function submit(){
            if(form.id == ""){
                router.post(route('author-detail.store', form.id), {
                    details: form.details,
                    author_general_id: props.generalId,
                });
            }else
                router.post(route('author-detail.update', form.id), {
                    _method: 'put',
                    details: form.details,
                    author_general_id: props.generalId,
                });
        }

        return { form, submit }
    },
}
</script>