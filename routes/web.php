<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\RelatorioController;
use Illuminate\Support\Facades\Auth;

Route::get('/', fn () => view('welcome'));

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::controller(FuncionarioController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::get('/funcionarios/create', 'create')->name('funcionarios.create');
        Route::post('/funcionarios', 'store')->name('funcionarios.store');
        Route::get('/funcionarios/show/{id}', 'show')->name('funcionarios.show');
        Route::get('/funcionarios/edit/{id}', 'edit')->name('funcionarios.edit');
        Route::put('/funcionarios/update/{id}', 'update')->name('funcionarios.update');
        Route::delete('/funcionarios/{id}', 'destroy')->name('funcionarios.destroy');
    });

    Route::controller(RelatorioController::class)->group(function () {
        Route::get('/relatorios/baixar', 'baixarRelatorio')->name('get-relatorios-baixar');
    });
});
