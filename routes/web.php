<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuncionarioController;
use Illuminate\Support\Facades\Auth;

Route::get('/', fn () => view('welcome'));

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\RelatorioController::class, 'index'])->name('buscar');

Route::controller(FuncionarioController::class)->group(function () {
    Route::get('/funcionarios', 'index')->name('funcionarios.index');
    Route::get('/funcionarios/create', 'create')->name('funcionarios.create');
    Route::post('/funcionarios', 'store')->name('funcionarios.store');
    Route::get('/funcionarios/show/{id}', 'show')->name('funcionarios.show');
    Route::get('/funcionarios/edit/{id}', 'edit')->name('funcionarios.edit');
    Route::post('/funcionarios/update/{id}', 'update')->name('funcionarios.update');
    Route::delete('/funcionarios/{id}', 'destroy')->name('funcionarios.destroy');
});

Route::controller('relatorios', 'RelatorioController')->group(function () {
    Route::get('/relatorios/baixar', 'baixarRelatorio')->name('get-relatorios-baixar');
});
