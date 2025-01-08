<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CommentController;

//ruta principal con el array de comentarios
Route::get('/comments',[CommentController::class, 'index']);

//ruta para con el formulario para crear los comentarios 
Route::get('/comments/create',[CommentController::class, 'create']);

//ruta post para añadir un comentario al array de comentarios 
Route::post('/comments', [CommentController::class, 'store']);

//ruta que devuelve el comentario seleccionado del array 
Route::get('/comments/{commentid}',[CommentController::class, 'show']);

//ruta para el formulario de modificacion de un comentario 
Route::get('/comments/{commentid}/edit', [CommentController::class,'edit']);

//peticion para modificar el comentario y devolver el array modificado 
Route::patch('/comments/{commentid}', [CommentController::class, 'update']);

//peticion para borrar completamente un comentario y retornar el array 
Route::delete('/comments/{commentid}', [CommentController::class, 'destroy']);
