<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         {{ __('Cadastro de Número') }}
      </h2>
   </x-slot>

   <div class="py-6">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
         <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <form action="{{ route('cadastroNumero') }}" method="POST">
               @csrf
               <x-text-input id="user_id" class="block mt-1 w-full" type="hidden" name="user_id" value="{{ Auth::user()->id }}" required autofocus />

               <div class="p-6 text-gray-900">
                  <x-input-label for="name" :value="__('Nome')" />
                  <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                  <x-input-error :messages="$errors->get('name')" class="mt-2" />
               </div>
               <div class="p-6 text-gray-900">
                  <x-input-label for="phone" :value="__('Número de telefone')" />
                  <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required />
                  <x-input-error :messages="$errors->get('phone')" class="mt-2" />
               </div>
               <div class="p-6 text-gray-900">
                  <x-input-label for="message" :value="__('Mensagem')" />
                  <x-text-input id="message" class="block mt-1 w-full" type="text" name="message" :value="old('message')" required />
                  <x-input-error :messages="$errors->get('message')" class="mt-2" />
               </div>
               <div class="p-6 text-gray-900">
                  <x-primary-button class="mt-4">
                     {{ __('Cadastrar Número') }}
                  </x-primary-button>
               </div>
            </form>
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
   </div>
</x-app-layout>