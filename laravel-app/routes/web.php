<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\ContactController;

Route::middleware('auth')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('projects', ProjectController::class);
    Route::get('inquiries', [InquiryController::class, 'index'])->name('inquiries.index');
});

Route::post('inquiries', [InquiryController::class, 'store'])->name('inquiries.store');
Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('contact', [ContactController::class, 'store'])->name('contact.store');
