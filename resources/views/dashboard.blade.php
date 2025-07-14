<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         {{ __('Dashboard') }}
      </h2>
   </x-slot>

   <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
         <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
               @forelse($clientes as $cliente)
               <div class="mb-4 border p-4 bg-gray-50">
                  <h3 class="text-lg font-semibold">{{ $cliente->name }}</h3>
                  <p>{{ $cliente->phone }}</p>
                  <p>{{ $cliente->message }}</p>
                  <p class="text-sm text-gray-600">Cadastrado por: {{ $cliente->user->name ?? 'Usuário Desconhecido' }}</p>
               </div>
               @empty
               <p class="text-gray-500">Nenhum cliente cadastrado.</p>
               @endforelse
            </div>
         </div>
      </div>
   </div>

   <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
      @if(session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
         <span class="block sm:inline">{{ session('success') }}</span>
      </div>
      @endif

      @if(session('error'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
         <span class="block sm:inline">{{ session('error') }}</span>
      </div>
      @endif
   </div>
</x-app-layout>