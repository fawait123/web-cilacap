<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>HITUNG CEPAT</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite('frontend/app.js')
    @routes
    @vite('frontend/assets/css/app.css')
    @inertiaHead
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    @inertia
</body>

</html>
