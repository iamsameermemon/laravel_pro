<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\TrashedNotesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('/notes', NoteController::class)->middleware(['auth']);

// Route::get('/trashed', [TrashedNotesController::class, 'index'])->middleware('auth')->name('trashed.index');

// Route::get('/trashed/{note}', [TrashedNotesController::class, 'show'])
//     ->withTrashed()
//     ->middleware('auth')->name('trashed.show');

// Route::put('/trashed/{note}', [TrashedNotesController::class, 'update'])
//     ->withTrashed()
//     ->middleware('auth')->name('trashed.update');

// Route::delete('/trashed/{note}', [TrashedNotesController::class, 'destroy'])
//     ->withTrashed()
//     ->middleware('auth')->name('trashed.destroy');


Route::prefix("/trashed")->name("trashed.")->middleware('auth')->group(function(){
    Route::get('/', [TrashedNotesController::class, 'index'])->name('index');
    Route::get('/{note}', [TrashedNotesController::class, 'show'])->withTrashed()->name('show');
    Route::put('/{note}', [TrashedNotesController::class, 'update'])->withTrashed()->name('update');
    Route::delete('/{note}', [TrashedNotesController::class, 'destroy'])->withTrashed()->name('destroy');
});
require __DIR__.'/auth.php';