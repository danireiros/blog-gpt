<template>

    <confirmation-modal :show="confirmDeleteActive">
        <template v-slot:title> Confirme la acción </template>

        <template v-slot:content>
            <p>¿Seguro que quieres eliminar el post?</p>
        </template>

        <template v-slot:footer>
            <o-button variant="danger" @click="deletePost">Eliminar</o-button>
            <div class="mr-3"></div>
            <o-button @click="confirmDeleteActive = false">Cancelar</o-button>
        </template>
    </confirmation-modal>

    <AppLayout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mt-5">
                <div class="card  mb-10">
                    <div class="card-body">
                        <h2 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">Posts</h2>
                        <Link class="link-button-default mb-3 hover:text-gray-100" :href="route('post.create')">Crear nuevo</Link>
                        <h2 class="mb-2 font-semibold text-gray-900 dark:text-white">Busqueda</h2>
                        <div class="">
                            <InputLabel for="">Texto</InputLabel>
                            <TextInput v-debounce:350ms="customSearch" :debounce-events="['change', 'keyup']" autofocus class="w-full" type="text" v-model="search"/>
                        </div>
                        <div class="grid grid-cols-4 gap-2 mb-5">
                            <div>
                                <InputLabel for="">Desde</InputLabel>
                                <TextInput @change="customSearch" class="w-full" v-model="from" placeholder="Desde..." type="date" />
                            </div>
                            <div>
                                <InputLabel for="">Hasta</InputLabel>
                                <TextInput @change="customSearch" class="w-full" v-model="to" placeholder="Desde..." type="date" />
                            </div>
                            <div>
                                <InputLabel for="">Publicado</InputLabel>
                                <select @change="customSearch" class="rounded-md w-full border-gray-300" v-model="posted">7
                                    <option :value="null">-</option>
                                    <option v-for="value in enumPosted" :key="value" :value="value" :selected="posted == value">
                                        {{ value }}
                                    </option>
                                </select>
                            </div>

                            <div>
                                <InputLabel for="">Tipo</InputLabel>
                                <select @change="customSearch" class="rounded-md w-full border-gray-300" v-model="type">
                                    <option :value="null">-</option>
                                    <option v-for="value in enumType" :key="value" :value="value">
                                        {{ value }}
                                    </option>
                                </select>
                            </div>

                            <div>
                                <InputLabel for="">Autor</InputLabel>
                                <select @change="customSearch" class="rounded-md w-full border-gray-300" v-model="author_id">
                                    <option :value="null">-</option>
                                    <option v-for="a in authors" :key="a.id" :value="a.id">
                                        {{ a.name }}
                                    </option>
                                </select>
                            </div>

                            <div>
                                <InputLabel for="">Categoría</InputLabel>
                                <select @change="customSearch" class="rounded-md w-full border-gray-300" v-model="category_id">
                                    <option :value="null">-</option>
                                    <option v-for="c in categories" :key="c.id" :value="c.id">
                                        {{ c.title }}
                                    </option>
                                </select>
                            </div>

                            <div>

                            </div>

                            <!-- <div>
                                <PrimaryButton @click="customSearch">
                                    Filtrar
                                </PrimaryButton>
                            </div> -->
                        </div>
                        <div class="mb-5">
                            <div>
                                <PrimaryButton @click="customSearch">
                                    Filtrar
                                </PrimaryButton>
                                <Link class="ml-3 text-gray-700 hover:text-gray-500" :href="route('post.index')">
                                    Borrar filtros
                                </Link>
                            </div>
                        </div>

                        <div v-if="posts.data.length > 0">
                            <h2 class="mb-2 font-semibold text-gray-900 dark:text-white">Listado</h2>
                            <table class="w-full border">
                                <thead class="bg-gray-200">
                                    <tr class="border-b">
                                        <th class="p-3 min-w-14 hover:bg-gray-300 cursor-pointer" @click="sort('id')">
                                            Id
                                            <template v-if="sortColumn == 'id'">
                                                <template v-if="sortDirection == 'desc'">&uarr;</template>
                                                <template v-else>&darr;</template>
                                            </template>
                                        </th>
                                        <th class="p-3">Autor</th>
                                        <th class="p-3 hover:bg-gray-300 cursor-pointer" @click="sort('title')">
                                            Titulo
                                            <template v-if="sortColumn == 'title'">
                                                <template v-if="sortDirection == 'desc'">&uarr;</template>
                                                <template v-else>&darr;</template>
                                            </template>
                                        </th>
                                        <!-- <th class="p-3">Slug</th> -->   
                                        <th class="p-3 hover:bg-gray-300 cursor-pointer" @click="sort('text')">
                                            Texto
                                            <template v-if="sortColumn == 'text'">
                                                <template v-if="sortDirection == 'desc'">&uarr;</template>
                                                <template v-else>&darr;</template>
                                            </template>
                                        </th>
                                        <th class="p-3 hover:bg-gray-300 cursor-pointer" @click="sort('description')">
                                            Descripción
                                            <template v-if="sortColumn == 'description'">
                                                <template v-if="sortDirection == 'desc'">&uarr;</template>
                                                <template v-else>&darr;</template>
                                            </template>
                                        </th>
                                        <th class="p-3">Categoría</th>
                                        <th class="p-3">Publicado</th>
                                        <th class="p-3">Tipo</th>
                                        <th class="p-3">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b" v-for="p in posts.data" :key="p.id">
                                        <td class="p-2">{{ p.id }}</td>
                                        <td class="p-2">
                                            <span><img class="h-8 w-8 rounded-full" :src="'/image/author/'+p.author.image">
                                            {{ p.author.name }}</span>
                                        </td>
                                        <td class="p-2 font-bold">{{ p.title }}</td>
                                        <!-- <td class="p-2">{{ p.slug }}</td> -->
                                        <td class="p-2">{{ p.text.substring(0, 15)+"..." }}</td>
                                        <td class="p-2">{{ p.description.substring(0, 15)+"..." }}</td>
                                        <td class="p-2">{{ p.category.title }}</td>
                                        <td class="p-2">
                                            <div v-if="p.posted == 'yes'">
                                                <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                                    Si
                                                </span>
                                            </div>
                                            <div v-else>
                                                <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                                                    No
                                                </span>
                                            </div>
                                        </td>
                                        <td class="p-2">{{ p.type }}</td>
                                        <td class="p-2">
                                            <Link as="button" class="text-sm text-purple-400 hover:text-purple-700 mx-2" :href="route('post.edit', p.id)">Editar</Link>
                                            <!-- <Link as="button" class="text-sm text-red-400 hover:text-red-700 mx-2" method="delete" :href="route('post.destroy', p.id)">Eliminar</Link> -->
                                            <button class="text-sm text-red-400 hover:text-red-700 mx-2"
                                                @click="confirmDeleteActive = true;deletePostRow = p.id;">Eliminar</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <pagination :links="posts"/>
                        </div>
                        <div v-else>
                            <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
                                <p>No hay posts</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
    import { Link, router } from '@inertiajs/vue3';
    import { ref } from "vue";

    import AppLayout from "@/Layouts/AppLayout.vue";
    import Pagination from '@/Shared/Pagination.vue';
    import ConfirmationModal from "@/Components/ConfirmationModal.vue";
    import PrimaryButton from "@/Components/PrimaryButton.vue";
    import TextInput from "@/Components/TextInput.vue";

    import vueDebounce from 'vue-debounce'
    
    export default {
        directives: {
            debounce: vueDebounce({ lock: true })
        },
        props: {
            posts: Object,
            authors: Object,
            categories: Object,
            enumPosted: Array,
            enumType: Array,
            filter_author_id: String,
            filter_category_id: String,
            filter_type: String,
            filter_posted: String,
            filter_search: String,
            filter_from: String,
            filter_to: String,
            sortColumn: String,
            sortDirection: String, 
        },
        data(props) {
            return {
                confirmDeleteActive: false,
                deletePostRow: "",
                author_id: props.filter_author_id,
                posted: props.filter_posted,
                type: props.filter_type,
                category_id: props.filter_category_id,
                search: props.filter_search,
                from: props.filter_from,
                to: props.filter_to,
                column: '',
            }
        }, 
        methods: {
            deletePost() {
                router.delete(route("post.destroy", this.deletePostRow));
                this.confirmDeleteActive = false;
            }, 
            customSearch(column = 'id') {
                router.get(route('post.index'),{
                    category_id: this.category_id,
                    author_id: this.author_id,
                    posted: this.posted,
                    type: this.type,
                    search: this.search,
                    from: this.from,
                    to: this.to,
                    sortColumn: this.column,
                    sortDirection: this.sortDirection == 'asc' ? 'desc' : 'asc',
                }, {
                    preserveState: true,
                    preserveScroll: true
                });
            },
            sort(column){
                this.column = column;
                this.customSearch();
            }
        },
        components: {
            Link,
            AppLayout,
            Pagination,
            ConfirmationModal,
            PrimaryButton,
            TextInput,
        },
        setup(props) {
            
        }
    }
</script>
