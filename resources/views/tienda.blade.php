<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Productos') }}

      @auth
      @if (Auth::user()->role == 'admin')
      <a href="/tienda/create">
        <x-button class="ml-3">
          {{ __('Nuevo Producto') }}
        </x-button>
      </a>
      @endif
      @endauth
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200 justify-content-center align-content-center">
          <div class="relative">
            @foreach($productos as $producto)
            <div class="border border-black-500 w-fit flex items-center">
              <img src="{{$producto->imagen}}" class="w-4/12">
              <h3 class="m-5">{{$producto->nombre}} {{$producto->precio}}€</h3>
              @auth
              <x-boton-tienda :href="$producto->id">
                Comprar
              </x-boton-tienda>
              @endauth
              <p>{{$producto->descripcion}}</p>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>