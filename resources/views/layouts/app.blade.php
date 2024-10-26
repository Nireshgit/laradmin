<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script>
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('f78381f8f3504852a889', {
                cluster: 'mt1'
            });

            var channel = pusher.subscribe('users');
                channel.bind('App\\Events\\UserLogged', function(data) {
                //app.messages.push(JSON.stringify(data));
                console.log(JSON.stringify(data));
            });

            // Vue application
            // const app = new Vue({
            //     el: '#app',
            //     data: {
            //         messages: [],
            //     },
            // });
            // Enable pusher logging - don't include this in production
            // Pusher.logToConsole = true;

            // var pusher = new Pusher('c95fbeb749c42f67d2dd', {
            //     cluster: 'mt1'
            // });

            // var channel = pusher.subscribe('users');
            // channel.bind('App\\Events\\UserLogged', function(data) {
            //     alert(JSON.stringify(data.data));
            //     console.log(data);
            // });
        </script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
