<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacturasController;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(FacturasController::class)->group(function () {
    Route::get('/facturas', 'index')->name('facturas.index');
    Route::get('/facturas/create', 'create')->name('facturas.create');
    Route::post('/facturas/store', 'store')->name('facturas.store');
    Route::get('/facturas/{id}', 'show')->name('facturas.show');
});


