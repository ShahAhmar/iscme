<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Admin\RegistrationController as AdminRegistrationController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SpeakerController;
use App\Http\Controllers\Admin\SponsorController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ImportantDateController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MenuController;

// Public Registration API & Captcha
Route::get('/api/captcha', [RegistrationController::class, 'getCaptcha'])->name('captcha.get');
Route::post('/register/submit', [RegistrationController::class, 'store'])->name('registration.submit');

Route::prefix('admin')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'create'])->name('admin.login');
        Route::post('login', [AuthController::class, 'store'])->middleware('throttle:6,1')->name('admin.login.store');
    });

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::post('logout', [AuthController::class, 'destroy'])->name('admin.logout');
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::resource('pages', PageController::class, ['as' => 'admin'])->except(['show', 'destroy']);
        Route::get('pages/{page}/builder', [PageController::class, 'builder'])->name('admin.pages.builder');
        Route::post('pages/{page}/builder', [PageController::class, 'saveBuilder'])->name('admin.pages.builder.save');
        Route::delete('pages/{page}', [PageController::class, 'destroy'])
            ->middleware('role:super_admin,admin')
            ->name('admin.pages.destroy');

        Route::resource('speakers', SpeakerController::class, ['as' => 'admin'])->except(['show', 'destroy']);
        Route::delete('speakers/{speaker}', [SpeakerController::class, 'destroy'])
            ->middleware('role:super_admin,admin')
            ->name('admin.speakers.destroy');

        Route::resource('sponsors', SponsorController::class, ['as' => 'admin'])->except(['show', 'destroy']);
        Route::delete('sponsors/{sponsor}', [SponsorController::class, 'destroy'])
            ->middleware('role:super_admin,admin')
            ->name('admin.sponsors.destroy');

        Route::resource('faqs', FaqController::class, ['as' => 'admin'])->except(['show', 'destroy']);
        Route::delete('faqs/{faq}', [FaqController::class, 'destroy'])
            ->middleware('role:super_admin,admin')
            ->name('admin.faqs.destroy');

        Route::resource('media', MediaController::class, ['as' => 'admin'])->only(['index', 'store', 'update', 'destroy']);
        Route::resource('posts', PostController::class, ['as' => 'admin'])->except('show');
        Route::resource('categories', CategoryController::class, ['as' => 'admin'])->only(['index', 'store', 'update', 'destroy']);
        Route::get('settings', [SettingController::class, 'index'])->name('admin.settings.index');
        Route::put('settings', [SettingController::class, 'update'])->name('admin.settings.update')->middleware('role:super_admin,admin');
        Route::resource('important-dates', ImportantDateController::class, ['as'=>'admin'])->only(['index','store','update','destroy']);
        Route::resource('users', UserController::class, ['as'=>'admin'])->only(['index','store','update','destroy'])->middleware('role:super_admin');
        Route::resource('menus', MenuController::class, ['as'=>'admin'])->only(['index','store','update','destroy'])->middleware('role:super_admin,admin');

        // Admin Registrations Management
        Route::get('registrations', [AdminRegistrationController::class, 'index'])->name('admin.registrations.index');
        Route::put('registrations/{registration}', [AdminRegistrationController::class, 'update'])->name('admin.registrations.update');
        Route::delete('registrations/{registration}', [AdminRegistrationController::class, 'destroy'])->name('admin.registrations.destroy');
        Route::get('registrations/export/csv', [AdminRegistrationController::class, 'exportCsv'])->name('admin.registrations.export');

        // Admin Documentation & Manuals
        Route::get('docs', function () { return Inertia::render('Admin/Docs/Index'); })->name('admin.docs.index');
        Route::get('docs/user-manual', function () { return Inertia::render('Admin/Docs/UserManual'); })->name('admin.docs.user-manual');
        Route::get('docs/technical-manual', function () { return Inertia::render('Admin/Docs/TechnicalManual'); })->name('admin.docs.technical-manual');
    });
});

// CMT Submission Acknowledgment Page
Route::get('/submission', function () {
    return 'CMT ACKNOWLEDGMENT
The Microsoft CMT service was used for managing the peer-reviewing process for this conference. This service was provided for free by Microsoft and they bore all expenses, including costs for Azure cloud services as well as for software development and support.';
});

// Dynamic Page Routing (Must be at the bottom)
Route::get('/{slug?}', [FrontendController::class, 'show'])->name('page.show');
