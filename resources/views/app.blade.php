<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    {{-- <meta name="viewport" content="width=1000, initial-scale=1, maximum-scale=1"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>BorderlessHR</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css?family=Inter:300,400,400i,600,700,800,900" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('/js/app.js') }}" defer></script>

    <script src="https://unpkg.com/vue/dist/vue.js" defer></script>
    <script src="https://unpkg.com/vue-router/dist/vue-router.js" defer></script>

    <style>
        html * {
            font-family: "Inter" !important;
        }

    </style>
</head>

<body>
    <div id="app">
        <router-view></router-view>
    </div>
</body>

</html>
