<template>
    <confirmation-modal :show="confirmBanUser">
        <template v-slot:title> Confirme la acción </template>

        <template v-slot:content>
            <p>{{ banModalText }}{{ currentUser }}?</p>
        </template>

        <template v-slot:footer>
            <o-button variant="danger" @click="banCurrentUser">Aceptar</o-button>
            <div class="mr-3"></div>
            <o-button @click="confirmBanUser = false">Cancelar</o-button>
        </template>
    </confirmation-modal>
    <AppLayout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mt-5">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">Usuarios</h2>

                        <div class="">
                            <InputLabel for="">Nombre o email</InputLabel>
                            <TextInput v-debounce:350ms="customSearch" :debounce-events="['change', 'keyup']" autofocus class="w-full mb-4" type="text" v-model="search"/>
                        </div>

                        <div v-if="users.data.length > 0">
                            <table class="w-full border">
                                <thead class="bg-gray-200">
                                    <tr class="border-b">
                                        <th class="p-3">ID</th>
                                        <th class="p-3">Avatar</th>
                                        <th class="p-3">Nombre</th>
                                        <th class="p-3">Email</th>
                                        <th class="p-3">Rol</th>
                                        <th class="p-3">Fecha de creación</th>
                                        <th class="p-3">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b" v-for="u in users.data" :key="u.id">
                                        <td class="p-2">{{ u.id }}</td>
                                        <td class="p-2">
                                            <img class="h-8 w-8 rounded-full"
                                                :src="profilePhoto(u.profile_photo_url)"
                                                alt="" />
                                        </td>
                                        <td class="p-2">{{ u.name }}</td>
                                        <td class="p-2">{{ u.email }}</td>
                                        <td class="p-2">
                                            <span v-if="u.role == 2">Usuario</span>
                                            <span v-else-if="u.role == 3" class="text-red-600">Baneado</span>
                                            <span v-else class="font-bold text-indigo-600">Admin</span>
                                        </td>
                                        <td class="p-2">{{ formatDate(u.created_at) }}</td>
                                        <td class="p-2" v-if="u.role == 2">
                                            <button class="text-sm text-red-400 hover:text-red-700 mx-2" @click="confirmBanUser = true; banUser = u.id; currentUser = u.name; banModalText = '¿Seguro que quieres banear a ';">Banear</button>
                                        </td>
                                        <td class="p-2" v-else-if="u.role == 3">
                                            <button class="text-sm text-green-400 hover:text-green-700 mx-2" @click="confirmBanUser = true; banUser = u.id; currentUser = u.name; banModalText = '¿Seguro que quieres reincorporar a ';">Reincorporar</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <pagination :links="users"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
    import { ref } from 'vue';
    import { Link, router } from '@inertiajs/vue3';
    import AppLayout from "@/Layouts/AppLayout.vue";
    import Pagination from '@/Shared/PaginationPrevNext.vue';
    import ConfirmationModal from "@/Components/ConfirmationModal.vue";
    import TextInput from "@/Components/TextInput.vue";

    import vueDebounce from 'vue-debounce'

    export default {
        directives: {
            debounce: vueDebounce({ lock: true })
        },
        components: {
            Link,
            AppLayout,
            Pagination,
            ConfirmationModal,
            TextInput
        },
        props: {
            users: Object,
            filter_search: String,
        },
        data(props) {
            return {
                confirmBanUser: false,
                banUser: "",
                search: props.filter_search,
            }
        },
        methods: {
            formatDate(dateString) {
                const date = new Date(dateString);
                let options = {
                    year: "numeric",
                    month: "long",
                    day: "numeric",
                    hour: "numeric",
                    minute: "numeric",
                    hour12: false,
                };
                return new Intl.DateTimeFormat(undefined, options).format(date);
            },
            banCurrentUser() {
                router.post(route("user.ban", this.banUser));
                this.confirmBanUser = false;
            },
            customSearch() {
                router.get(route('user.index'),{
                    search: this.search,
                }, {
                    preserveState: true,
                    preserveScroll: true
                });
            },
        },
        setup(props) {
            const currentUser = ref('');
            const banModalText = ref('');

            const profilePhoto = (url) => {
                return url.replace(/.*\/profile-photos/, '/image/profile-photos');
            };

            return {
                profilePhoto,
            };
        }
    }
</script>
