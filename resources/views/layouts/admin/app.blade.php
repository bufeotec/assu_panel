<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Assu</title>
    <link rel="shortcut icon" href="{{asset('isologo.ico')}}" />

    @vite(['resources/css/app.css','resources/js/app.js'])
    @livewireStyles

</head>
<body>

@include('layouts.admin.topbar')
@include('layouts.admin.sidebar')

<div class="p-4 sm:ml-64">
    <div class="p-4 mt-14">
        @yield('content')
    </div>
</div>



@livewireScripts

<script src="{{asset('js/dark-mode.js')}}"></script>


</body>
</html>
