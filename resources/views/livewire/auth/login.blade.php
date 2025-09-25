<div>

    <form class="space-y-4 md:space-y-6" wire:submit.prevent="iniciarSesion" >

        <div>
            <x-input
                label="Nombre de usuario"
                id="username"
                name="username"
                wire:model="username"
                placeholder="assuAdmin..."
                autofocus
            />
        </div>
        <div>
            <x-input
                type="password"
                label="Contraseña"
                id="password"
                name="password"
                wire:model="password"
                placeholder="••••••••"

            />
        </div>
        <div class="flex items-center justify-between">
            <div class="flex items-start">
                <div class="flex items-center h-5">
                    <x-input
                        type="checkbox"
                        id="remember"
                        name="remember"
                        wire:model="remember"
                        placeholder="assuAdmin..."
                        autofocus
                    />
                </div>
                <div class="ml-3 text-sm">
                    <label for="remember" class="text-gray-500 dark:text-gray-300">Recuérdame</label>
                </div>
            </div>
            <a href="{{route('password.request')}}" class="text-sm font-medium text-assu hover:underline dark:text-white">¿Olvidaste tu contraseña?</a>
        </div>

        @if (session()->has('error'))
            <x-alert type="danger"  message="{{ session('error') }}" />
        @endif
        @if (session()->has('status'))
            <x-alert type="success"  message="{{ session('status') }}" />
        @endif

        <x-button type="submit" wireTarget="iniciarSesion">
            Iniciar sesión
        </x-button>

        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
            ¿Desea solicitar una demo?
            <a href="https://bufeotec.com/#contacto" target="_blank" class="font-medium text-primary-600 hover:underline dark:text-primary-500">
                Contáctanos
            </a>
        </p>
    </form>
</div>
