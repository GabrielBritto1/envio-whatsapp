<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class DadosController extends Controller
{
   /**
    * Display a listing of the resource.
    */
   public function index()
   {
      $clientesPorDDD = Cliente::selectRaw('SUBSTRING(phone, 1, 2) as ddd, COUNT(*) as total')
         ->groupBy('ddd')
         ->orderBy('ddd')
         ->get();

      return view('dados-cadastrados', [
         'clientesPorDDD' => $clientesPorDDD
      ]);
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
      //
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
