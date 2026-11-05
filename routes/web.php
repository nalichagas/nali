<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TesteController;

Route::get('/', function () {
    return view('portfolio');
});


Route::get('/helpdesk', [HelpdeskController::class, 'index'])->name('helpdesk');

Route::get('/helpdesk', [HelpdeskController::class, 'salvar'])->name('helpdesk.salvar');

