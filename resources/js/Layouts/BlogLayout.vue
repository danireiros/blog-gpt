<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import Footer from '@/Components/Footer.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

const logout = () => {
    router.post(route('logout'));
};

// flash message
const visibleFlashContainer = ref(true);

const hideFlashMessage = () => {
    setTimeout(() => visibleFlashContainer.value = false, 3000);
    return true;
};

const profilePhoto = (url) => {
    return url.replace(/.*\/profile-photos/, '/image/profile-photos');
};
</script>

<template>
    <div class="overflow-y-auto" scroll-region>
        <Head :title="title" />

        <Banner />

        <div class="min-h-screen pb-28 bg-neutral-50 dark:bg-gray-900">
            <nav class="bg-neutral-100 border-b border-gray-100">

                <div class="w-100 px-2 flex justify-center h-12">
                    <h2 class="m-2 text-indigo-400">
                        <Link :href="route('blog.index')">
                            <ApplicationMark class="block h-9 w-auto inline-flex" />
                            <h1 class="ml-2 text-4xl inline-flex text-indigo-800 text-2xl font-bold tracking-tightdark:text-white text-indigo-800 transition"
                            :style="{ fontFamily: 'Jersey', fontWeight: 'normal', fontStyle: 'normal' }">
                                InfoParaTi
                            </h1>
                        </Link>
                    </h2>
                </div>

                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <!-- <div class="shrink-0 flex items-center">
                                <Link :href="route('blog.index')">
                                    <ApplicationMark class="block h-9 w-auto" />
                                </Link>
                            </div> -->

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                <NavLink :href="route('blog.index')" :active="route().current('blog.index')">
                                    Inicio
                                </NavLink>
                            </div>

                            <slot name="catnavs" />
                        </div>

                        <div v-if="$page.props.auth.user" class="hidden sm:flex sm:items-center sm:ms-6">
                            <!-- Settings Dropdown -->
                            <div class="ms-3 relative inline-flex">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex items-center mr-3 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 transition duration-150 ease-in-out">{{ $page.props.auth.user.name }}</span>
                                        <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                            <img class="h-8 w-8 rounded-full"
                                                :src="profilePhoto($page.props.auth.user.profile_photo_url)"
                                                alt="" />
                                        </button>

                                        <span v-else class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                                                {{ $page.props.auth.user.name }}

                                                <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <!-- Account Management -->
                                        <div class="block px-4 py-2 mb-0 text-xs text-gray-400">
                                            Opciones
                                        </div>

                                        <DropdownLink v-if="$page.props.auth.user.role == 1" :href="route('post.index')">
                                            Administración
                                        </DropdownLink>

                                        <DropdownLink :href="route('profile.show')">
                                            Perfil
                                        </DropdownLink>

                                        <DropdownLink v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')">
                                            API Tokens
                                        </DropdownLink>

                                        <div class="border-t border-gray-200 dark:border-gray-600" />

                                        <!-- Authentication -->
                                        <form @submit.prevent="logout">
                                            <DropdownLink as="button">
                                                Cerrar sesión
                                            </DropdownLink>
                                        </form>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>
                        <div v-else  class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <NavLink :href="route('login')" :active="route().current('login')">
                                Unirse
                            </NavLink>
                            <NavLink :href="route('register')" :active="route().current('register')">
                                Registrarse
                            </NavLink>
                        </div>

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out" @click="showingNavigationDropdown = ! showingNavigationDropdown">
                                <svg
                                    class="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <!-- <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Dashboard
                        </ResponsiveNavLink> -->
                        <div v-if="!$page.props.auth.user">
                            <ResponsiveNavLink :href="route('login')" :active="route().current('login')">
                                Unirse
                            </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('register')" :active="route().current('register')">
                                Registrarse
                            </ResponsiveNavLink>
                        </div>

                        <ResponsiveNavLink :href="route('blog.index')" :active="route().current('blog.index')">
                            Inicio
                        </ResponsiveNavLink>

                        <slot name="catnavs_responsive" />
                    </div>

                    <!-- Responsive Settings Options -->
                    <div v-if="$page.props.auth.user" class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                        <div class="flex items-center px-4">
                            <div v-if="$page.props.jetstream.managesProfilePhotos" class="shrink-0 me-3">
                                <img class="h-8 w-8 rounded-full"
                                    :src="profilePhoto($page.props.auth.user.profile_photo_url)"
                                    alt="" />
                            </div>

                            <div>
                                <div class="font-medium text-base text-gray-800 dark:text-gray-200">
                                    {{ $page.props.auth.user.name }}
                                </div>
                                <div class="font-medium text-sm text-gray-500">
                                    {{ $page.props.auth.user.email }}
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink v-if="$page.props.auth.user.role == 1" :href="route('post.index')" :active="route().current('post.index')">
                                Administración
                            </ResponsiveNavLink>

                            <ResponsiveNavLink :href="route('profile.show')" :active="route().current('profile.show')">
                                Perfil
                            </ResponsiveNavLink>

                            <ResponsiveNavLink v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')" :active="route().current('api-tokens.index')">
                                API Tokens
                            </ResponsiveNavLink>

                            <!-- Authentication -->
                            <form method="POST" @submit.prevent="logout">
                                <ResponsiveNavLink as="button">
                                    Cerrar sesión
                                </ResponsiveNavLink>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header v-if="$slots.header" class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>

                <div v-if="$page.props.auth.user">
                    <div v-if="$page.props.auth.user.role == 3">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
                            <div class="container my-2 rounded-sm shadow-sm bg-red-100 border-l-4 border-red-500 text-red-700 p-8" role="alert">
                                <p><strong class="text-red-700">Cuenta baneada</strong></p>
                                <br>
                                <p>No puedes comentar ni dar likes.</p>
                                <p>Contacte a <a href="mailto:contacto@infoparati.es">contacto@infoparati.es</a> para mas información.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <transition>
                    <div v-if="visibleFlashContainer">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div v-if="$page.props.flash.message && hideFlashMessage()" class="container my-2 rounded-sm shadow-sm bg-purple-100 border-l-4 border-purple-500 text-purple-700 p-4" role="alert">
                                <p>{{ $page.props.flash.message }}</p>
                            </div>
                        </div>
                    </div>
                </transition>

                <slot />
            </main>
        </div>

        <Footer></Footer>

    </div>
</template>
