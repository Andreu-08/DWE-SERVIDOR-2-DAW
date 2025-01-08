<?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\ProductsController;

    Route::get('/',[ProductsController::class,'index']);
    Route::get('/ofertas', [ProductsController::class, 'mostrarOfertas']);
    Route::get('/seleccion', [ProductsController::class, 'mostrarSeleccion']);
    Route::get('/topventas', [ProductsController::class, 'mostrarTopVentas']);
    Route::get('/producto/{id}', [ProductsController::class, 'mostrarProducto']);
