@extends('layouts.auth.app-auth')
@section('title','Restablecer Contraseña')
@section('content')


    <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700 mx-auto">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">

            <h1 class="text-xl text-center font-bold leading-tight tracking-tight mb-1 text-gray-900 md:text-2xl dark:text-white">
                ¿Has olvidado tu contraseña? 🔒
            </h1>
            <p class="font-normal text-gray-700 dark:text-gray-400 text-center">Ingresa tu correo para restablecer tu contraseña.</p>
            @livewire('auth.forgot-password')
        </div>
    </div>


@endsection
