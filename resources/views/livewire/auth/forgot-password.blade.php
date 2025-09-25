<div>
    <form class="space-y-4 md:space-y-6" wire:submit.prevent="enviarCorreo" >

        <div class="mt-8">
            <x-input
                type="email"
                label="Correo Electrónico"
                id="email"
                name="email"
                wire:model="email"
                placeholder="ejemplo@gmail.com"
                autofocus
            />
        </div>

        @if (session()->has('error'))
            <x-alert type="danger"  message="{{ session('error') }}" />
        @endif
        @if (session()->has('success'))
            <x-alert type="success"  message="{{ session('success') }}" />
        @endif

        <x-button type="submit" class="mt-3" wireTarget="enviarCorreo">
           ENVIAR ENLACE DE RECUPERACIÓN
        </x-button>

    </form>
</div>
