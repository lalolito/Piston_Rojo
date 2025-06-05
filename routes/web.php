<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CitasController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\ProveedorController;
use App\Http\Middleware\RolAdmin;
use App\Http\Middleware\RolCliente;

/*
|--------------------------------------------------------------------------
| Rutas públicas
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Rutas login con Google
|--------------------------------------------------------------------------
*/
Route::post('/google-login', [App\Http\Controllers\Auth\GoogleLoginController::class, 'login']);

/*
|--------------------------------------------------------------------------
| Rutas autenticadas comunes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Rutas de perfil
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Rutas para ADMINISTRADOR
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', RolAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/inicio', function () {
        return view('admin.inicio');
    })->name('inicio');

    // Proveedores
    Route::prefix('proveedores')->name('proveedores.')->group(function () {
        Route::get('/', [ProveedorController::class, 'index'])->name('index');
        Route::get('/crear', [ProveedorController::class, 'create'])->name('create');
        Route::post('/guardar', [ProveedorController::class, 'store'])->name('store');
        Route::get('/editar/{id}', [ProveedorController::class, 'edit'])->name('edit');
        Route::put('/actualizar/{id}', [ProveedorController::class, 'update'])->name('update');
        Route::put('/estado/{id}', [ProveedorController::class, 'cambiarEstado'])->name('estado');
    });

    // Inventario (con Route Model Binding)
    Route::prefix('inventario')->name('inventario.')->group(function () {
        Route::get('/', [InventarioController::class, 'index'])->name('index');
        Route::get('/crear', [InventarioController::class, 'create'])->name('create');
        Route::post('/guardar', [InventarioController::class, 'store'])->name('store');
        Route::get('/editar/{inventario}', [InventarioController::class, 'edit'])->name('edit');
        Route::put('/actualizar/{inventario}', [InventarioController::class, 'update'])->name('update');
        Route::delete('/eliminar/{inventario}', [InventarioController::class, 'destroy'])->name('destroy');
    });

    // Citas
    Route::prefix('citas')->name('citas.')->group(function () {
        Route::get('/', [CitasController::class, 'adminIndex'])->name('index');
        Route::get('/crear', [CitasController::class, 'adminCreate'])->name('create');
        Route::post('/guardar', [CitasController::class, 'adminStore'])->name('store');
        Route::get('/editar/{id}', [CitasController::class, 'adminEdit'])->name('edit');
        Route::put('/actualizar/{id}', [CitasController::class, 'adminUpdate'])->name('update');
        Route::delete('/eliminar/{id}', [CitasController::class, 'adminDelete'])->name('delete');
    });

});

/*
|--------------------------------------------------------------------------
| Rutas para CLIENTE
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', RolCliente::class])->prefix('cliente')->name('cliente.')->group(function () {
    Route::get('/inicio', function () {
        return view('cliente.inicio');
    })->name('inicio');

    // Citas del cliente
    Route::prefix('citas')->name('citas.')->group(function () {
        Route::get('/', [CitasController::class, 'clienteIndex'])->name('index');
        Route::get('/crear', [CitasController::class, 'clienteCreate'])->name('create');
        Route::post('/guardar', [CitasController::class, 'clienteStore'])->name('store');
    });
});

/*
|--------------------------------------------------------------------------
| Autenticación (Laravel Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
