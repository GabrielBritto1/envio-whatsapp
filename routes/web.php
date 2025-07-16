<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DadosController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
   return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
   Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
   Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
   Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

   Route::get('/cadastro-numero', [ClienteController::class, 'index'])->name('cadastroNumero');
   Route::post('/cadastro-numero', [ClienteController::class, 'store'])->name('cadastroNumero.store');

   Route::get('/dados-cadastrados', [DadosController::class, 'index'])->name('dadosCadastrados');
});

require __DIR__ . '/auth.php';
