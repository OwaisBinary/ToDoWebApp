<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ToDoController;

Route::prefix('categories')->group(function () {

    Route::post('/', [CategoryController::class, 'store'])->name('categories.store');

    Route::put('/{category}', [CategoryController::class, 'update'])->name('categories.update');

    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

});

Route::prefix('todos')->group(function () {

    Route::post('/', [TodoController::class, 'store'])->name('todos.store');

    Route::put('/{todo}', [TodoController::class, 'update'])->name('todos.update');

    Route::delete('/{todo}', [TodoController::class, 'destroy'])->name('todos.destroy');

    Route::patch('/{todo}/toggle', [TodoController::class, 'toggle'])->name('todos.toggle');

});

Route::get('/', [CategoryController::class, 'index'])->name('home');