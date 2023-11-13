<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ZK Super Store') }}</title>

    <!-- Fonts -->
    
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    
    <!-- Style -->
    
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        
    @livewireStyles  
</head>
<body>
    @include('layouts.inc.user.navbar')

         <main class="py-4">
            @yield('content')
        </main>
    @include('layouts.inc.user.footer')
    

<!-- Scripts -->
<script src="{{ asset('assets/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
@livewireScripts
</body>
</html>
