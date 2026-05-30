<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProgramController;

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
Route::view('/destinations/china/sdut', 'pages.universities.sdut')->name('china.sdut');
Route::view('/destinations/china/jufe', 'pages.universities.jufe')->name('china.jufe');
Route::view('/destinations/china/hmu',  'pages.universities.hmu')->name('china.hmu');

Route::post('/enquiry', [EnquiryController::class, 'store'])->name('enquiry.store');
Route::post('/contact', [EnquiryController::class, 'contact'])->name('contact.store');

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware('auth')->group(function () {
    Route::get('/portal', [AuthController::class, 'portal'])->name('portal');

    // Profile
    Route::get('/portal/profile', [ProfileController::class, 'show'])->name('portal.profile');
    Route::put('/portal/profile', [ProfileController::class, 'update'])->name('portal.profile.update');

    // Application
    Route::get('/portal/apply', [ApplicationController::class, 'create'])->name('portal.apply');
    Route::post('/portal/apply', [ApplicationController::class, 'store'])->name('portal.apply.store');
    Route::get('/portal/application/{application}', [ApplicationController::class, 'show'])->name('portal.application');
    Route::post('/portal/application/{application}/submit', [ApplicationController::class, 'submit'])->name('portal.application.submit');

    // Documents
    Route::get('/portal/application/{application}/documents', [DocumentController::class, 'index'])->name('portal.documents');
    Route::post('/portal/application/{application}/documents', [DocumentController::class, 'store'])->name('portal.documents.store');
    Route::delete('/portal/documents/{document}', [DocumentController::class, 'destroy'])->name('portal.documents.destroy');
});

// Admin routes
Route::middleware(['auth','admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/',                                  [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/applications',                      [AdminController::class, 'applications'])->name('applications');
    Route::get('/applications/{application}',        [AdminController::class, 'showApplication'])->name('application.show');
    Route::patch('/applications/{application}/status',[AdminController::class, 'updateStatus'])->name('application.status');

    Route::get('/programs',                 [ProgramController::class, 'index'])->name('programs');
    Route::get('/programs/create',          [ProgramController::class, 'create'])->name('programs.create');
    Route::post('/programs',                [ProgramController::class, 'store'])->name('programs.store');
    Route::get('/programs/{program}/edit',  [ProgramController::class, 'edit'])->name('programs.edit');
    Route::put('/programs/{program}',       [ProgramController::class, 'update'])->name('programs.update');
    Route::delete('/programs/{program}',    [ProgramController::class, 'destroy'])->name('programs.destroy');
});
