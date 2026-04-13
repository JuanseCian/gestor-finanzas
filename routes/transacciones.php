<?php

use App\Http\Controllers\backend\TransaccionController;

Route::middleware(['auth'])->group(function () {
    Route::resource('transacciones', TransaccionController::class);
});