<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

// Guest Routes (accessible to users who are not logged in)
Route::middleware('guest')->group(function () {
    // Register Route
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    
    // Login Routes
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    
    // Forgot Password Routes
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');
    
    // Reset Password Routes
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

// Authenticated User Routes (accessible to logged in users)
Route::middleware('auth')->group(function () {
    // Email Verification Routes
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');
    
    // Confirm Password Route
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
    
    // Update Password Route
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
    
    // Logout Route
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
