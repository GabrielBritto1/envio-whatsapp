<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EvolutionApiController extends Controller
{
   public function sendMessage(Request $request)
   {
      $validated = $request->validate([
         'instanceName' => 'required|string',
         'number' => 'required|string',
         'message' => 'required|string',
      ]);

      try {
         $apiUrl = config('services.evolution.url'); // Pega de config/services.php
         $apiKey = config('services.evolution.key');

         // Usando o cliente HTTP do Laravel, que é muito mais limpo
         $response = Http::withHeaders([
            'apikey' => $apiKey
         ])->post(
            "{$apiUrl}/message/sendText/{$validated['instanceName']}",
            [
               // Este é o payload corrigido que descobrimos
               'number' => $validated['number'],
               'text' => $validated['message']
            ]
         );

         // Retorna a resposta da API diretamente
         return $response->json();
      } catch (\Exception $e) {
         return response()->json(['error' => 'Falha ao enviar mensagem.', 'message' => $e->getMessage()], 500);
      }
   }
}
