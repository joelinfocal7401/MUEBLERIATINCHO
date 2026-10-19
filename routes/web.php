<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CategoriaMuebleController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\MuebleStockController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\VentaController;

use App\Http\Controllers\PublicoController;

Route::get('/',[PublicoController::class,'home'])->name('home');

Route::get(
    '/catalogo',
    [PublicoController::class, 'catalogo']
)->name('catalogo');
//ver
Route::get(
    '/catalogo/{id}',
    [PublicoController::class, 'detalle']
)->name('muebles.detalle');

Route::get(
    '/nosotros',
    [PublicoController::class, 'nosotros']
)->name('nosotros');

Route::get(
    '/contacto',
    [PublicoController::class, 'contacto']
)->name('contacto');

//carrito 
Route::post('/carrito/agregar/{id}', [PublicoController::class, 'agregarCarrito'])
    ->name('compra.agregar');

Route::get('/carrito', [PublicoController::class, 'carrito'])
    ->name('compra.carrito');

Route::patch('/carrito/actualizar/{id}', [PublicoController::class, 'actualizarCarrito'])
    ->name('compra.actualizar');

Route::delete('/carrito/eliminar/{id}', [PublicoController::class, 'eliminarDelCarrito'])
    ->name('compra.eliminar');

Route::post('/carrito/solicitar-cotizacion', [PublicoController::class, 'solicitarCotizacion'])
    ->middleware('auth')
    ->name('compra.solicitar');


//google
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');

Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    });

    //clien
    Route::middleware(['auth', 'cliente'])->group(function () {

    Route::get('/mis-pedidos', [DashboardController::class, 'misPedidos'])
        ->name('cliente.mis-pedidos');

    Route::get('/mi-perfil', function () {
        return view('cliente.perfil');
    })->name('cliente.perfil');

    //ver
    Route::post(
        '/mis-pedidos/{id}/aceptar',
        [DashboardController::class, 'aceptarCotizacion']
    )->name('cliente.cotizacion.aceptar');
    Route::post(
        '/mis-pedidos/{id}/notificar-pago',
        [DashboardController::class, 'notificarPago']
    )->name('cliente.pago.notificar');

    Route::post(
        '/mis-pedidos/{id}/cancelar-pago',
        [DashboardController::class, 'cancelarPago']
    )->name('cliente.pago.cancelar');

});


    // admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('categorias', CategoriaMuebleController::class);
    Route::resource('materiales',MaterialController::class);
    Route::resource('proveedores',ProveedorController::class);
    Route::resource('muebles-stock', MuebleStockController::class)
    ->parameters([
        'muebles-stock' => 'muebleStock',
    ]);
    Route::resource('pedidos',PedidoController::class);

    Route::get('/solicitudes-web', [VentaController::class,'solicitudesWeb'])->name('solicitudes-web.index');

    Route::get(
    '/solicitudes-web/{id}/cotizar',
    [VentaController::class, 'formularioCotizacion']
    )->name('solicitudes-web.cotizar');
    
    Route::resource('ventas',VentaController::class);


    Route::post(
    '/solicitudes-web/{id}/cotizar',
    [VentaController::class, 'guardarCotizacion']
    )->name('solicitudes-web.guardar-cotizacion');

    // Ver pagos web notificados
    Route::get(
        '/solicitudes-web/pagos-notificados',
        [VentaController::class, 'pagosNotificados']
    )->name('solicitudes-web.pagos-notificados');

    // Confirmar un pago web verificado
    Route::post(
        '/solicitudes-web/{id}/confirmar-pago',
        [VentaController::class, 'confirmarPagoWeb']
    )->name('solicitudes-web.confirmar-pago');



});



require __DIR__.'/auth.php';
