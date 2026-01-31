<?php

use App\Http\Controllers\EventoController;
use App\Http\Controllers\InstitutoController;
use App\Http\Controllers\TipoEventoController;
use App\Http\Controllers\DependenciaController;
use App\Http\Controllers\OrganizadorController;
use Illuminate\Support\Facades\Route;

// Ruta de inicio
Route::get('/', function () {
    return redirect()->route('eventos.index');
});

// TEMPORAL: Rutas de eventos SIN autenticación para desarrollo
// TODO: Descomentar el middleware('auth') cuando se implemente autenticación
Route::resource('eventos', EventoController::class);
// ->middleware('auth');

// TEMPORAL: Rutas de catálogos SIN protección para desarrollo
// TODO: Agregar middleware(['auth', 'role:administrador']) cuando se implemente autenticación
Route::resource('institutos', InstitutoController::class);
Route::resource('tipos-evento', TipoEventoController::class);
Route::resource('dependencias', DependenciaController::class);
Route::resource('organizadores', OrganizadorController::class);

/*
Route::middleware('auth')->group(function () {
    Route::resource('eventos', EventoController::class);
    
    Route::middleware('role:administrador')->group(function () {
        Route::resource('institutos', InstitutoController::class);
        Route::resource('tipos-evento', TipoEventoController::class);
        Route::resource('dependencias', DependenciaController::class);
        Route::resource('organizadores', OrganizadorController::class);
    });
});
*/