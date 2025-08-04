<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iTala</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-white dark:bg-gray-900">
    @if (Route::has('login'))
    <div class="fixed top-0 right-0 px-6 py-4 sm:block">
        @auth
        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-300 underline">Dashboard</a>
        @else
        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-300 underline">Log in</a>
        @endauth
    </div>
    @endif

    <div class="min-h-screen flex flex-col justify-center items-center">
        <div>
            <h1 class=" font-bold text-gray-900 dark:text-white" style="font-size: 5rem;">Welcome to iTala</h1>
        </div>

        <p class="mt-6 text-lg text-gray-600 dark:text-gray-400" style="font-aiw: 2.5rem;">
            <!--Your mental health guided by professionals made accessible in Dipolog.*/ -->
            Guiding every step to better mental health in Dipolog.
    </div>
</body>

</html>