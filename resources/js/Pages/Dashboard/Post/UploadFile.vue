<template>
    <AppLayout>
        <div class="container">
       
            <div class="md:grid md:grid-cols-3 md:gap-6 max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 mt-2">            
                <div class="md:col-span-1 flex justify-between">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100"> Subir imagen para {{ post.title }} </h3>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400"> Imagen de portada del post </p>
                    </div>
                    <div class="px-4 sm:px-0">

                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2 mb-2">
                    <div class="px-4 py-5 bg-white dark:bg-gray-800 sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6">
                                <!-- <InputLabel for="image">Imagen</InputLabel>
                                <InputError :message="errors.image"/>
                                <TextInput class="w-full rounded-none" type="file" @input="form.image = $event.target.files[0]" />
                                <PrimaryButton class="mt-1" @click="upload">
                                    Subir imagen
                                </PrimaryButton> -->

                                <InputLabel for="">Imagen</InputLabel>
                                <section>
                                    <o-field class="file">
                                        <o-upload v-slot="{ onclick }" v-model="form.image">
                                            <o-button tag="button" variant="primary" @click="onclick">
                                                <o-icon icon="upload" />
                                                <span>Seleccionar imagen</span>
                                            </o-button>
                                        </o-upload>
                                        <span v-if="form.image != ''" class="file-name">
                                            Imagen cargada <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                                            </svg>
                                        </span>
                                        <span v-else class="file-name">
                                            
                                        </span>
                                    </o-field>
                                </section>

                                <PrimaryButton class="mt-1" @click="upload">
                                    Subir imagen
                                </PrimaryButton>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import { useForm, router } from "@inertiajs/vue3";

import { ref } from 'vue';
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
        post: Object,
    },
    setup(props) {
        const form = useForm({
            id: props.post.id,
            title: props.post.title,
            image: ''
        })

        function upload(){
            router.post(route('post.upload', form.id), form);
        }

        return { form, upload }
    },
    
}
</script>