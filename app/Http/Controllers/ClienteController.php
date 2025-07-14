<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

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
