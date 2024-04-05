<template>
    <AppLayout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mt-5">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-4xl mb-4 font-bold text-gray-900 dark:text-white">
                            Bienvenido {{ $page.props.auth.user.name }}
                        </h2>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                            <a :href="route('post.index')">Posts</a>
                        </h2>
                        <p class="mb-4">Panel de creación, edicion y eliminacion de noticias manualmente con filtro de busqueda</p>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white"><a :href="route('category.index')">Categorias</a></h2>
                        <p class="mb-4">Panel de creación, edicion y eliminacion de categorías para las noticias y los autores</p>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white"><a :href="route('author.index')">Autores</a></h2>
                        <p class="mb-4">Autores de las noticias</p>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white"><a :href="route('openai.index')">OpenAi</a></h2>
                        <p class="mb-4">Configuracion de modelos de texto e imagen de OpenAi para usar en la generacion de noticias</p>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white"><a :href="route('web.index')">Webs</a></h2>
                        <p class="mb-4">Configuraciones de webs de donde se obtendrán los links para generar noticias</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h2 class="text-4xl mb-4 font-bold text-gray-900 dark:text-white">
                            ¡Primeros pasos!
                        </h2>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">1) Crea una categoría</h2>
                        <p>Entre en <a :href="route('category.create')">crear categoría</a></p>
                        <p>Escriba un nombre, color y un icono. El slug es opcional y se generará solo si se queda en blanco</p>

                        <h2 class="mt-4 text-xl font-semibold text-gray-900 dark:text-white">2) Crea un autor</h2>
                        <p>Entre en <a :href="route('author.create')">crear autor</a></p>
                        <p>Asignele un nombre, avatar, descripción, categoría y una subcategoria opcional</p>
                        <p>Escriba un prompt que será usado por la IA para generar las noticias.</p>
                        <p>Ejemplo de prompt: <span class="italic">Amante del deporte de motor, narra todo de forma muy épica y con mucha emoción</span></p>
                    
                        <h2 class="mt-4 text-xl font-semibold text-gray-900 dark:text-white">3) Añada un modelo de texto</h2>
                        <p>Entre <a href="https://platform.openai.com/docs/models">aqui</a> y busque su modelo de texto a usar</p>
                        <p>Ejemplo: <span class="italic">gpt-4-0125-preview</span></p>
                        <p>Ahora entre en <a :href="route('text.create')">añadir modelo de texto</a> para añadir el modelo</p>
                        <p>Pongale el nombre que quiera y en Nombre del modelo de openAi añada el nombre como esta en openai, en este caso <span class="italic">gpt-4-0125-preview</span></p>
                    
                        <h2 class="mt-4 text-xl font-semibold text-gray-900 dark:text-white">4) Añada un modelo de imagen</h2>
                        <p>Entre <a href="https://platform.openai.com/docs/models">aqui</a> y busque su modelo de imagen a usar</p>
                        <p>Ejemplo: <span class="italic">dall-e-3</span></p>
                        <p>Ahora entre en <a :href="route('image.create')">añadir modelo de imagen</a> para añadir el modelo</p>
                        <p>Pongale el nombre que quiera y en Nombre del modelo de openAi añada el nombre como esta en openai, en este caso <span class="italic">dall-e-3</span></p>
                        <p>Revise el tamaño de imagenes soportado por el modelo y añadalo, en este caso <span class="italic">1024x1024</span></p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h2 class="text-4xl mb-4 font-bold text-gray-900 dark:text-white">
                            ¡Genere noticias con IA!
                        </h2>

                        <h2 class="mt-4 text-xl font-semibold text-gray-900 dark:text-white">5) Añada una web de la que quiera generar noticias</h2>
                        <p>En construcción...</p>

                        <h2 class="mt-4 text-xl font-semibold text-gray-900 dark:text-white">6) ¡Genere una noticia solo con clickar el link!</h2>
                        <p>En construcción...</p>

                        <h2 class="mt-4 text-xl font-semibold text-gray-900 dark:text-white">7) Publique su noticia</h2>
                        <p>Al generar una noticia esta se genera en estado 'pendiente'</p>
                        <p>Para publicarlo vaya a la opción de estado, seleccione publicado y guarde</p>
                        <p><strong>¡Y listo!</strong> su noticia estara publicada en la <a :href="route('blog.index')">aqui</a> de la web</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h2 class="text-4xl mb-4 font-bold text-gray-900 dark:text-white">
                            Crear noticias manualmente
                        </h2>

                        <h2 class="mt-4 text-xl font-semibold text-gray-900 dark:text-white">1) Cree un post</h2>
                        <p>Entre <a :href="route('post.create')">aquí</a> y rellene todos los campos</p>
                        <p>En construcción...</p>
                        <p><strong>¡Y listo!</strong> su noticia estara publicada en la <a :href="route('blog.index')">aqui</a> de la web</p>
                    </div>
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
        Pagination
    },
    props: {
        webs: Object,
        webLinks: Object,
    }
}
</script>