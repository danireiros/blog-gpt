<template>
    <div class="container mt-0 m-auto p-5 pt-0">
        <h2 class="mb-4 mt-0 text-2xl font-bold tracking-tight text-gray-700 dark:text-white">Comentarios</h2>
        Comentarios bla bla bla...
        <hr>
        <FormSection2 @submitted="submit">
            <template #form>
                <div class="col-span-6">
                    <InputLabel for="">Comentar</InputLabel>
                    <textarea v-model="form.text" class="p-3 h-48 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full"></textarea>
                </div>
                {{ post_id }}
            </template>
            <template #actions>
                <PrimaryButton class="link-button-default mb-3 hover:text-gray-100 mt-2" @click.prevent="submit">Publicar</PrimaryButton>
            </template>
            <Link as="button" class="link-button-default mb-3 hover:text-gray-100" :href="route('post.edit', 1)">Publicar</Link>
        </FormSection2>
    </div>
</template>

<script>
    import { useForm, Link, router } from '@inertiajs/vue3';
    import FormSection2 from "@/Components/FormSection2.vue";
    import InputLabel from "@/Components/InputLabel.vue";
    import PrimaryButton from "@/Components/PrimaryButton.vue";

    export default {
        components: {
            Link,
            FormSection2,
            InputLabel,
            useForm,
        },
        props:{
            errors: Object,
            comments: Object,
            post_id: Number,
        },
        setup(props) {
            const form = useForm({
                text: null,
                post_id: props.post_id,
            });

            function submit(){
                router.post(route('comments.store', form));
            }

            return { form, submit }
        },
    }
</script>
