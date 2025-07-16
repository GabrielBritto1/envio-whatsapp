<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         {{ __('Dados cadastrados') }}
      </h2>
   </x-slot>

   <div class="py-6">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
         <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
               <canvas id="graficoClientes"></canvas>
            </div>
         </div>
      </div>
   </div>

   <!-- Importa Chart.js -->
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <script>
      const ctx = document.getElementById('graficoClientes').getContext('2d');
      const chart = new Chart(ctx, {
         type: 'bar',
         data: {
            labels: {!! json_encode($clientesPorDDD->pluck('ddd')) !!},
            datasets: [{
               label: 'DDD de clientes',
               data: {!! json_encode($clientesPorDDD->pluck('total')) !!},
               backgroundColor: 'rgba(75, 192, 192, 0.2)',
               borderColor: 'rgba(75, 192, 192, 1)',
               borderWidth: 1
            }]
         }
      });
   </script>
</x-app-layout>