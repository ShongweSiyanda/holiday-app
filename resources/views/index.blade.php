<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Holidays App</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/sass/app.scss','resources/css/app.css'])
</head>
<body>
<div id="app" class="bg-secondary min-vh-100 bg-opacity-50">
    <main class="container mx-auto py-lg-5 py-4">
        <home-component></home-component>
    </main>
</div>
@vite('resources/js/app.js')
</body>
</html>





