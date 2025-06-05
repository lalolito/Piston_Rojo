<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CitasController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\ProveedorController;

/*
|---------------------------------------------------------------------------
| API Rutas para la app móvil
|---------------------------------------------------------------------------
|
| Estas rutas retornan JSON para consumo móvil.
| Para seguridad, puedes usar middleware 'auth:sanctum' o token en producción.
|
*/

// Perfil del usuario autenticado
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [ProfileController::class, 'apiShow']);
    Route::put('/profile', [ProfileController::class, 'apiUpdate']);
    Route::delete('/profile', [ProfileController::class, 'apiDestroy']);
});

// Proveedores - CRUD completo
Route::middleware('auth:sanctum')->prefix('proveedores')->group(function () {
    Route::get('/', [ProveedorController::class, 'apiIndex']);
    Route::post('/', [ProveedorController::class, 'apiStore']);
    Route::get('/{id}', [ProveedorController::class, 'apiShow']);
    Route::put('/{id}', [ProveedorController::class, 'apiUpdate']);
    Route::put('/estado/{id}', [ProveedorController::class, 'apiCambiarEstado']);
    Route::delete('/{id}', [ProveedorController::class, 'apiDestroy']);
});

// Inventario - CRUD completo
Route::middleware('auth:sanctum')->prefix('inventario')->group(function () {
    Route::get('/', [InventarioController::class, 'apiIndex']);
    Route::post('/', [InventarioController::class, 'apiStore']);
    Route::get('/{id}', [InventarioController::class, 'apiShow']);
    Route::put('/{id}', [InventarioController::class, 'apiUpdate']);
    Route::delete('/{id}', [InventarioController::class, 'apiDestroy']);
});

// Citas (diferenciando admin y cliente puede hacerse con middleware o rutas distintas)
Route::middleware('auth:sanctum')->prefix('citas')->group(function () {
    // Admin citas
    Route::get('/admin', [CitasController::class, 'apiAdminIndex']);
    Route::post('/admin', [CitasController::class, 'apiAdminStore']);
    Route::get('/admin/{id}', [CitasController::class, 'apiAdminShow']);
    Route::put('/admin/{id}', [CitasController::class, 'apiAdminUpdate']);
    Route::delete('/admin/{id}', [CitasController::class, 'apiAdminDestroy']);

    // Cliente citas
    Route::get('/cliente', [CitasController::class, 'apiClienteIndex']);
    Route::post('/cliente', [CitasController::class, 'apiClienteStore']);
    Route::get('/cliente/{id}', [CitasController::class, 'apiClienteShow']);
});
