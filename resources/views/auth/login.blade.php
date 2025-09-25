@extends('layouts.auth.app-auth')
@section('title','Iniciar Sesión')
@section('content')


    <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700 mx-auto">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
{{--            <a href="#" class="flex items-center justify-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">--}}
{{--                <img class="w-20 h-20 mr-2" src="{{asset('isologo.ico')}}" alt="logo">--}}
{{--            </a>--}}
            <h1 class="text-xl text-center font-bold leading-tight tracking-tight mb-1 text-gray-900 md:text-2xl dark:text-white">
                Inicia sesión en tu cuenta
            </h1>
            <p class="font-normal text-gray-700 dark:text-gray-400 text-center">Introduce tus credenciales para continuar.</p>
            @livewire('auth.login')
        </div>
    </div>


@endsection
