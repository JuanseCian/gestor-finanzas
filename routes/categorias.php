<?php

use App\Http\Controllers\backend\CategoriaController;

Route::middleware(['auth'])->group(function () {
    Route::resource('categorias', CategoriaController::class);
});