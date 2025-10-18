<?php

use Illuminate\Support\Facades\Route;

// Srylius :: Admin (Guest)
Route::middleware(['guest:admin', 'admin'])->name('admin.')->group(function () {
    // Srylius :: Admin (Authentication > Login)
    Route::get('/auth/login', [Admin\Authentication\LoginController::class, 'index'])->name('login');
    // Srylius :: Admin (Authentication > Login > Store)
    Route::post('/auth/login', [Admin\Authentication\LoginController::class, 'store'])->name('login.store');

    // Srylius :: Admin (Authentication > Forgot)
    Route::get('/auth/forgot', [Admin\Authentication\ForgotController::class, 'index'])->name('forgot');
    // Srylius :: Admin (Authentication > Forgot > Store)
    Route::post('/auth/forgot', [Admin\Authentication\ForgotController::class, 'store'])->name('forgot.store');

    // Srylius :: Admin (Authentication > Reset)
    Route::get('/auth/reset/{token?}', [Admin\Authentication\ResetController::class, 'index'])->name('reset');
    // Srylius :: Admin (Authentication > Reset > Store)
    Route::post('/auth/reset/{token?}', [Admin\Authentication\ResetController::class, 'store'])->name('reset.store');
});

// Srylius :: Web (Guest)
Route::middleware(['guest:web', 'web'])->name('web.')->group(function () {
    // Srylius :: Web (Authentication > Login)
    Route::get('/auth/login', [Web\Authentication\LoginController::class, 'index'])->name('login');
    // Srylius :: Web (Authentication > Login > Store)
    Route::post('/auth/login', [Web\Authentication\LoginController::class, 'store'])->name('login.store');

    // Srylius :: Web (Authentication > Register)
    Route::get(__('page.web.authentication.route.register'), [Web\Authentication\RegisterController::class, 'index'])->name('register');
    // Srylius :: Web (Authentication > Register > Store)
    Route::post(__('page.web.authentication.route.register'), [Web\Authentication\RegisterController::class, 'store'])->name('register.store');

    // Srylius :: Web (Authentication > Forgot)
    Route::get('/auth/forgot', [Web\Authentication\ForgotController::class, 'index'])->name('forgot');
    // Srylius :: Web (Authentication > Forgot > Store)
    Route::post('/auth/forgot', [Web\Authentication\ForgotController::class, 'store'])->name('forgot.store');

    // Srylius :: Web (Authentication > Reset)
    Route::get('/auth/reset/{token?}', [Web\Authentication\ResetController::class, 'index'])->name('reset');
    // Srylius :: Web (Authentication > Reset > Store)
    Route::post('/auth/reset/{token?}', [Web\Authentication\ResetController::class, 'store'])->name('reset.store');
});
