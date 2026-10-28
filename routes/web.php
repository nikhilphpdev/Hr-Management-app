<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\DepartmentController;

Route::inertia('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {



Route::middleware('role:admin,hr')->group(function () {
        Route::get('departments',[DepartmentController::class , 'index'])->name('departments.index');

});
    Route::inertia('dashboard', 'dashboard')->name('dashboard');
});
require __DIR__.'/settings.php';
