<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Citas Programadas') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <form method="POST" action="/dashboard/citas/{{ $cita->id }}">
            @csrf
            @method('PUT')

            <!-- Fecha -->
            <div>
              <x-label for="fecha" :value="__('Fecha')" />

              <x-input id="fecha" class="block mt-1 w-full" type="date" name="fecha" value="{{$cita->fecha}}" required autofocus />
            </div>

            <!-- Hora -->
            <div class="mt-4">
              <x-label for="hora" :value="__('Hora')" />

              <select name="hora" id="hora" class="w-full">
                <option value="10">10:00</option>
                <option value="11">11:00</option>
                <option value="12">12:00</option>
                <option value="13">13:00</option>
                <option value="17">17:00</option>
                <option value="18">18:00</option>
              </select>
            </div>

            <!-- Observaciones -->
            <div class="mt-4">
              <x-label for="observaciones" :value="__('Observaciones')" />

              <x-input id="observaciones" class="block mt-1 w-full" type="text" name="observaciones" value="{{$cita->observaciones}}" required />
            </div>

            <!-- Servicio -->
            <div class="mt-4">
              <x-label for="servicio" :value="__('Servicio')" />

              <select name="servicio" id="servicio" class="w-full">
                @foreach($servicios as $servicio)
                <option value=" {{$servicio->id}}">{{$servicio->servicios}}</option>
                @endforeach
              </select>
            </div>

            <x-button class="ml-4 mt-2">
              {{ __('Editar Cita') }}
            </x-button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <script>
    window.addEventListener('load', function() {
      cargarHoras;
      document.getElementById("fecha").addEventListener("change", cargarHoras);
    });

    function cargarHoras() {
      let hora = document.getElementById('hora');
      for ($hora of $horas){
        
      }
    }
  </script>
</x-app-layout>