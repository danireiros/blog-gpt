<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="canonical" href="https://infoparati.es">

        <!-- META TAGS -->
        @if(isset($page['props']['event']))
            <title>{{ (isset($page['props']['event']['title'])) ? $page['props']['event']['title'] : '' }}</title>
            <meta property="og:url" content="{{ (isset($page['props']['event']['url'])) ? $page['props']['event']['url'] : '' }}" />
            <meta property="og:title" content="{{ (isset($page['props']['event']['title'])) ? $page['props']['event']['title'] : '' }}" />
            <meta property="og:description" content="{{ (isset($page['props']['event']['description'])) ? $page['props']['event']['description'] : '' }}" />
            <meta property="og:image" content="{{ (isset($page['props']['event']['image'])) ? $page['props']['event']['image'] : '' }}" />

            <meta name="twitter:title" content="{{ (isset($page['props']['event']['title'])) ? $page['props']['event']['title'] : '' }}" />
            <meta name="twitter:description" content="{{ (isset($page['props']['event']['description'])) ? $page['props']['event']['description'] : '' }}" />
            <meta name="twitter:image" content="{{ (isset($page['props']['event']['site'])) ? $page['props']['event']['image'] : '' }}" />

            <meta property="og:description" content="{{ (isset($page['props']['event']['description'])) ? $page['props']['event']['description'] : '' }}" />
        @else
            <title>Explora las últimas noticias sobre tecnología, actualidad, deporte, videojuegos, etc. Mantente actualizado con análisis profundos y artículos informativos.</title>
            <meta property="og:url" content="https://infoparati.es">
            <meta property="og:title" content="Inicio">
            <meta property="og:description" content="Explora las últimas noticias sobre tecnología, actualidad, deporte, videojuegos, etc. Mantente actualizado con análisis profundos y artículos informativos.">
            <meta property="og:image" content="https://infoparati.es/image/logo/infoparati_land.webp?33">

            <meta name="twitter:title" content="Inicio">
            <meta name="twitter:description" content="Explora las últimas noticias sobre tecnología, actualidad, deporte, videojuegos, etc. Mantente actualizado con análisis profundos y artículos informativos.">
            <meta name="twitter:image" content="https://infoparati.es/image/logo/infoparati_land.webp?33">

            <meta name="description" content="Explora las últimas noticias sobre tecnología, actualidad, deporte, videojuegos, etc. Mantente actualizado con análisis profundos y artículos informativos." />
        @endif
        <meta name="author" content="InfoParaTi">
        <!-- END META TAGS -->

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
