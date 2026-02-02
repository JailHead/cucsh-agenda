<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\InstitutoController;
use App\Http\Controllers\TipoEventoController;
use App\Http\Controllers\DependenciaController;
use App\Http\Controllers\OrganizadorController;


Route::get('/', function () {
    return redirect()->route('eventos.index');
});

Route::get('/dashboard', function () {
    return redirect()->route('eventos.index');
})->middleware(['auth'])->name('dashboard');

// Rutas protegidas con autenticación
Route::middleware('auth')->group(function () {    
    Route::resource('eventos', EventoController::class);
    
    // Rutas de catálogos - Solo administradores
    Route::middleware('role:administrador')->group(function () {
        Route::resource('institutos', InstitutoController::class);
        Route::resource('tipos-evento', TipoEventoController::class);
        Route::resource('dependencias', DependenciaController::class);
        Route::resource('organizadores', OrganizadorController::class);
    });
});

require __DIR__.'/auth.php';
