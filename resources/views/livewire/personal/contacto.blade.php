<div>
    <x-filament::section>
        <x-slot name="heading">
            Contactos:
        </x-slot>
        <div class="flex flex-wrap gap-6"> <!-- Aquí se añade flex-wrap para que los elementos no se salgan del contenedor -->
            @foreach ($contactos as $contacto)
                <div class="flex flex-col items-start"> <!-- Cada contacto está dentro de un div que se alineará en columna -->
                    <h3 class="font-bold">{{ $contacto->tipoContacto->tipo_contacto }}:</h3>
                    <p class="font-light">{{ $contacto->contacto }}</p>
                </div>
            @endforeach
        </div>
    </x-filament::section>
</div>
