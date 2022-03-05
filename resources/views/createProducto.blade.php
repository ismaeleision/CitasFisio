<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Producto Ofertado') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <form method="POST" action="{{ route('tienda.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Nombre -->
            <div>
              <x-label for="nombre" :value="__('Nombre')" />
              <x-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="old('nombre')" required autofocus />
            </div>

            <!-- Precio -->
            <div>
              <x-label for="precio" :value="__('Precio')" />
              <x-input id="precio" class="block mt-1 w-full" type="number" name="precio" :value="old('precio')" required autofocus />
            </div>

            <!-- Descripcion -->
            <div>
              <x-label for="descripcion" :value="__('Descripcion')" />
              <x-input id="descripcion" class="block mt-1 w-full" type="text" name="descripcion" :value="old('descripcion')" required autofocus />
            </div>

            <!-- Imagen -->
            <div class="mt-4">
              <x-label for="imagen" :value="__('Imagen')" />
              <x-input id="imagen" class="block mt-1 w-full" type="file" name="imagen" />
            </div>

            <x-button class="ml-4 mt-2">
              {{ __('Nuevo Producto') }}
            </x-button>
        </div>
        </form>
      </div>
    </div>
  </div>
  </div>
</x-app-layout>