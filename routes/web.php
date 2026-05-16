<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnquiryController;

Route::view('/', 'pages.home')->name('home');
Route::view('/programmes', 'pages.programmes')->name('programmes');
Route::view('/destinations/china', 'pages.study-in-china')->name('china');
Route::view('/destinations/malaysia', 'pages.study-in-malaysia')->name('malaysia');
Route::view('/scholarship', 'pages.scholarship')->name('scholarship');
Route::view('/application', 'pages.application')->name('application');
Route::view('/contact', 'pages.contact')->name('contact');
Route::view('/events/virtual-fair', 'pages.virtual-fair')->name('virtual-fair');

Route::post('/enquiry', [EnquiryController::class, 'store'])->name('enquiry.store');
Route::post('/contact', [EnquiryController::class, 'contact'])->name('contact.store');
