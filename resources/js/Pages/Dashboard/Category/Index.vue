<template>
    <AppLayout>

        <div class="container mt-5">
            <div class="card">
                <div class="card-body">
                    <Link class="link-button-default mb-3" :href="route('category.create')">Crear</Link>
                    <table class="w-full border">
                        <thead class="bg-gray-200">
                            <tr class="border-b">
                                <th class="p-3">ID</th>
                                <th class="p-3">Titulo</th>
                                <th class="p-3">Slug</th>
                                <th class="p-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b" v-for="c in categories.data" :key="c.id">
                                <td class="p-2">{{ c.id }}</td>
                                <td class="p-2">{{ c.title }}</td>
                                <td class="p-2">{{ c.slug }}</td>
                                <td class="p-2">
                                    <Link as="button" class="text-sm text-purple-400 hover:text-purple-700 mx-2" :href="route('category.edit', c.id)">Editar</Link>
                                    <Link as="button" class="text-sm text-red-400 hover:text-red-700 mx-2" method="delete" :href="route('category.destroy', c.id)">Eliminar</Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <pagination :links="categories"/>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
    import { Link, router } from '@inertiajs/vue3';

    import AppLayout from "@/Layouts/AppLayout.vue";
    import Pagination from '@/Shared/Pagination.vue';
    
    export default {
        components: {
            Link,
            AppLayout,
            Pagination,
        },
        props: {
            categories: Object,
        }
    }
</script>
