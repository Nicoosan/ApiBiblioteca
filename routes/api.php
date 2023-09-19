<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModelBibliotecaController;

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::get('/', function() {
    return response ()-> json([
        'Success' => true
    ]);
});

Route::get('/livros',[ModelBiblioteca::class,'index']);
Route::get('/livros{id}',[ModelBiblioteca::class,'show']);
Route::post('/livros',[ModelBibliotecaController::class,'store']);
Route::delete('/livros{id}',[ModelBibliotecaController::class,'destroy']);
Route::put('/livros/{id}',[ModelBibliotecaController::class,'update']);