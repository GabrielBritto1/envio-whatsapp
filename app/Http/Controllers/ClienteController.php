<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ClienteController extends Controller
{
   /**
    * Display a listing of the resource.
    */
   public function index()
   {
      return view('cadastro-numero');
   }

   /**
    * Show the form for creating a new resource.
    */
   public function create()
   {
      //
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(Request $request)
   {
      $validated = $request->validate([
         'name' => 'required|string|max:255',
         'phone' => 'required|string|max:15',
         'message' => 'required|string|max:500',
         'user_id' => 'required|string|max:255',
      ]);

      Cliente::create([
         'name' => $validated['name'],
         'phone' => $validated['phone'],
         'message' => $validated['message'],
         'user_id' => $validated['user_id'],
      ]);

      try {
         // 3. FORMATAÇÃO DO NÚMERO
         // Pega o telefone validado e formata para o padrão da API (ex: 5532999998888)
         $formattedPhone = '55' . preg_replace('/[^0-9]/', '', $validated['phone']);

         // 4. CHAMADA À API
         $apiKey = config('services.evolution.key'); // A key podemos manter
         $instanceName = 'teste_local';

         // Vamos ignorar a configuração e usar a URL que SABEMOS que funciona
         // Também adicionamos um timeout de 30 segundos por segurança
         $response = Http::withHeaders([
            'apikey' => $apiKey
         ])->timeout(30)->post("http://api:8080/message/sendText/{$instanceName}", [
            'number' => $formattedPhone,
            'text' => $validated['message']
         ]);

         // 5. VERIFICAÇÃO DE ERRO DA API
         if ($response->failed()) {
            // Se a API retornar um erro (4xx ou 5xx), registre para depuração
            Log::error('Falha ao enviar mensagem pela Evolution API', [
               'status' => $response->status(),
               'body' => $response->body()
            ]);
            // Redireciona com uma mensagem de erro específica da API
            return back()->with('error', 'Cliente cadastrado, mas a mensagem não pôde ser enviada via WhatsApp.');
         }
      } catch (\Exception $e) {
         // Se ocorrer um erro de conexão (timeout, etc.), registre-o
         Log::error('Exceção ao tentar se comunicar com a Evolution API', [
            'message' => $e->getMessage()
         ]);
         // Redireciona com uma mensagem de erro genérica de conexão
         return back()->with('error', 'Cliente cadastrado, mas houve uma falha de comunicação com o serviço de WhatsApp.');
      }

      return redirect()->route('cadastroNumero')->with('success', 'Número cadastrado com sucesso!');
   }

   /**
    * Display the specified resource.
    */
   public function show(string $id)
   {
      //
   }

   /**
    * Show the form for editing the specified resource.
    */
   public function edit(string $id)
   {
      //
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(Request $request, string $id)
   {
      //
   }

   /**
    * Remove the specified resource from storage.
    */
   public function destroy(string $id)
   {
      //
   }
}
