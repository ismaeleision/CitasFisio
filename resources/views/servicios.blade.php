<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Servicios Prestados') }}
      <a href="/dashboard/servicios/create">
        <x-button class="ml-3">
          {{ __('Nuevo Servicio ') }}
        </x-button>
      </a>
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <table class="auto w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                <!-- Para añadir a la web mas de un fisio/masajista que sera el id del usuario con el tipo fisio
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Masajista</th>
-->
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Imagen</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach($servicios as $servicio)
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">{{ $servicio->servicios}}</div>
                </td>
                <!-- Para añadir a la web mas de un fisio/masajista que sera el id del usuario con el tipo fisio
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">{{ $servicio->masajista }}</div>
                </td>
-->
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900"><img src="{{ $servicio->imagen}}" width='300px'></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <a href="/dashboard/servicios/delete/{{ $servicio->id }}" data-method='delete' class="text-indigo-600 hover:text-indigo-900">Delete</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>