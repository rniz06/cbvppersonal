<div>
    <x-filament::section>
        <x-slot name="heading">
            Emergencias:
        </x-slot>
        <div class="flex flex-wrap gap-6">
            <!-- Aquí se añade flex-wrap para que los elementos no se salgan del contenedor -->
            @forelse ($emergencias as $emergencia)
                <div class="flex flex-col items-start">
                    <!-- Cada contacto está dentro de un div que se alineará en columna -->
                    <h3 class="font-bold">{{ $emergencia->parentesco->parentesco }}: {{ $emergencia->nombre_completo }}</h3>
                    <p class="font-light">{{ $emergencia->tipoContacto->tipo_contacto }}: {{ $emergencia->contacto }}</p>
                </div>
            @empty
                <p class="italic">* No hay datos...</p>
            @endforelse
        </div>
    </x-filament::section>
</div>
