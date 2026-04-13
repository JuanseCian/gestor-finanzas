<?php

use App\Http\Controllers\backend\CuentaController;

Route::middleware(['auth'])->group(function () {
    Route::resource('cuentas', CuentaController::class);
});