<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      MIS PEDIDOS
    </h2>

    <div class="container mx-auto mt-5">
    </div>

  </x-slot>

  <div class="py-12">
    <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">

          <!-- This example requires Tailwind CSS v2.0+ -->
          <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                  <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                      <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gastos de envío</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id='mitabla'>
                      @foreach($pedidos as $pedido)
                      <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                          <div class="text-sm text-gray-900">{{ $pedido->fecha}}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                          <div class="text-sm text-gray-900">{{ $pedido->estado }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $pedido->gastos_envio }}€</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                          <a href="/dashboard/pedidos/{{ $pedido->id }}" class="text-indigo-600 hover:text-indigo-900">
                            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-2 rounded">
                              Ver detalle
                            </button>
                          </a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  {{ $pedidos->links() }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>