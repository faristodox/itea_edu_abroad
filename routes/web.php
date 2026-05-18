<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\AuthController;

Route::view('/', 'pages.home')->name('home');
Route::view('/programmes', 'pages.programmes')->name('programmes');
Route::view('/destinations/china', 'pages.study-in-china')->name('china');
Route::view('/destinations/malaysia', 'pages.study-in-malaysia')->name('malaysia');
Route::view('/scholarship', 'pages.scholarship')->name('scholarship');
Route::view('/application', 'pages.application')->name('application');
Route::view('/contact', 'pages.contact')->name('contact');
Route::view('/events/virtual-fair', 'pages.virtual-fair')->name('virtual-fair');

// University pages
Route::view('/destinations/china/zust', 'pages.universities.zust')->name('china.zust');

Route::post('/enquiry', [EnquiryController::class, 'store'])->name('enquiry.store');
Route::post('/contact', [EnquiryController::class, 'contact'])->name('contact.store');

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/portal', [AuthController::class, 'portal'])->name('portal')->middleware('auth');
