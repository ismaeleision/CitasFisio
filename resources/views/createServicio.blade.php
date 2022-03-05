<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Servicios Prestados') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <form method="POST" action="{{ route('servicios.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Fecha -->
            <div>
              <x-label for="servicios" :value="__('Servicios')" />
              <x-input id="servicios" class="block mt-1 w-full" type="text" name="servicios" :value="old('servicios')" required autofocus />
            </div>

            <!-- Imagen -->
            <div class="mt-4">
              <x-label for="imagen" :value="__('Imagen')" />
              <x-input id="imagen" class="block mt-1 w-full" type="file" name="imagen" />
            </div>

            <!--
            <input type="hidden" id="masajista_id" value="{{ Auth::id() }}">
            -->

            <x-button class="ml-4 mt-2">
              {{ __('Nuevo Servicio') }}
            </x-button>
        </div>
        </form>
      </div>
    </div>
  </div>
  </div>
</x-app-layout>