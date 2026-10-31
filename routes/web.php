<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\DepartmentController;
use \App\Http\Controllers\PositionController;
use \App\Http\Controllers\EmployeeController;
use \App\Http\Controllers\LeaveRequestController;

Route::inertia('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {



Route::middleware('role:admin,hr')->group(function () {
        Route::get('departments',[DepartmentController::class , 'index'])->name('departments.index');
        Route::post('departments',[DepartmentController::class , 'store'])->name('departments.store');
        Route::patch('departments/{department}',[DepartmentController::class , 'update'])->name('departments.update');
        Route::delete('departments/{department}',[DepartmentController::class , 'destroy'])->name('departments.destroy');

    
        Route::get('positions', [PositionController::class, 'index'])->name('positions.index');
        Route::post('positions', [PositionController::class, 'store'])->name('positions.store');
        Route::patch('positions/{position}', [PositionController::class, 'update'])->name('positions.update');
        Route::delete('positions/{position}', [PositionController::class, 'destroy'])->name('positions.destroy');
});

    Route::middleware('role:admin,hr,manager')->group(function () {
        Route::get('employees', [EmployeeController::class, 'index'])->name('employees.index');
        Route::get('employees/{employee}', [EmployeeController::class, 'show'])->name('employees.show');
    });

// Only HR & admins can create, edit or remove employees.
    Route::middleware('role:admin,hr')->group(function () {
        Route::post('employees', [EmployeeController::class, 'store'])->name('employees.store');
        Route::patch('employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
        Route::delete('employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
    });


      // Everyone signed in can view the leave list and file a request…
    Route::get('leave-requests', [LeaveRequestController::class, 'index'])->name('leave-requests.index');
    Route::post('leave-requests', [LeaveRequestController::class, 'store'])->name('leave-requests.store');


    Route::middleware('role:admin,hr,manager')->group(function (){
        Route::patch('leave-requests/{leaveRequest}/approve', [LeaveRequestController::class, 'approve'])->name('leave-requests.approve');
        Route::patch('leave-requests/{leaveRequest}/reject', [LeaveRequestController::class, 'reject'])->name('leave-requests.reject');
    });


    Route::inertia('dashboard', 'dashboard')->name('dashboard');
});
require __DIR__.'/settings.php';
