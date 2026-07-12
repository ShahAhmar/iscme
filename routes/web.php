<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

use App\Http\Controllers\FrontendController;

use App\Http\Controllers\Admin\PageController;

Route::prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Page Management
    Route::resource('pages', PageController::class, ['as' => 'admin']);
    
    // Page Builder Routes
    Route::get('pages/{page}/builder', [PageController::class, 'builder'])->name('admin.pages.builder');
    Route::post('pages/{page}/builder', [PageController::class, 'saveBuilder'])->name('admin.pages.builder.save');
});

// Dynamic Page Routing (Must be at the bottom)
Route::get('/{slug?}', [FrontendController::class, 'show'])->name('page.show');
