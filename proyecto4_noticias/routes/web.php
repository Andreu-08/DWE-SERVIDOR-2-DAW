<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\NoticiaController;

Route::get('/', [NoticiaController::class, 'index']);
Route::get('/search/{term}', [NoticiaController::class, 'search']);
Route::get('/view/{noticia}', [NoticiaController::class, 'view']);
