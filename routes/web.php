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

// CMT Submission Acknowledgment Page
Route::get('/submission', function () {
    return 'CMT ACKNOWLEDGMENT
The Microsoft CMT service was used for managing the peer-reviewing process for this conference. This service was provided for free by Microsoft and they bore all expenses, including costs for Azure cloud services as well as for software development and support.';
});

// Dynamic Page Routing (Must be at the bottom)
Route::get('/{slug?}', [FrontendController::class, 'show'])->name('page.show');
