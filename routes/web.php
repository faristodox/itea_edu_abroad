<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\DocumentTypeController;
use App\Http\Controllers\PaymentController;

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
    Route::get('/portal/application/{application}/edit', [ApplicationController::class, 'edit'])->name('portal.apply.edit');
    Route::put('/portal/application/{application}', [ApplicationController::class, 'update'])->name('portal.apply.update');
    Route::post('/portal/application/{application}/submit', [ApplicationController::class, 'submit'])->name('portal.application.submit');

    // Documents
    Route::get('/portal/application/{application}/documents', [DocumentController::class, 'index'])->name('portal.documents');
    Route::post('/portal/application/{application}/documents', [DocumentController::class, 'store'])->name('portal.documents.store');
    Route::delete('/portal/documents/{document}', [DocumentController::class, 'destroy'])->name('portal.documents.destroy');

    // Offer letter download (student)
    Route::get('/portal/application/{application}/offer-letter', function(\App\Models\Application $application) {
        abort_unless($application->user_id === auth()->id(), 403);
        abort_unless($application->offer_letter_path, 404);
        $path = storage_path('app/' . $application->offer_letter_path);
        abort_unless(file_exists($path), 404);
        return response()->download($path, 'offer-letter.pdf');
    })->name('portal.offer-letter');

    // Payment
    Route::get('/portal/application/{application}/checkout', [PaymentController::class, 'checkout'])->name('payment.checkout');
    Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/thankyou/{application}', function(\App\Models\Application $application) {
        abort_unless($application->user_id === auth()->id(), 403);
        return view('auth.payment-success', compact('application'));
    })->name('payment.thankyou');
    Route::get('/portal/application/{application}/receipt', function(\App\Models\Application $application) {
        abort_unless($application->user_id === auth()->id(), 403);
        abort_unless($application->isPaid(), 403);
        $application->load('user');
        return view('auth.receipt', compact('application'));
    })->name('portal.receipt');
});

// Stripe webhook (no auth — Stripe POSTs here)
Route::post('/stripe/webhook', [PaymentController::class, 'webhook'])->name('stripe.webhook');

// Admin routes
Route::middleware(['auth','admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/',                                  [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/applications',                      [AdminController::class, 'applications'])->name('applications');
    Route::get('/applications/{application}',        [AdminController::class, 'showApplication'])->name('application.show');
    Route::patch('/applications/{application}/status',[AdminController::class, 'updateStatus'])->name('application.status');

    Route::get('/documents/{document}/download',           [AdminController::class, 'downloadDocument'])->name('document.download');
    Route::post('/applications/{application}/offer-letter', [AdminController::class, 'uploadOfferLetter'])->name('admin.offer-letter.upload');
    Route::get('/offer-letter/{application}/download', function(\App\Models\Application $application) {
        abort_unless($application->offer_letter_path, 404);
        $path = storage_path('app/' . $application->offer_letter_path);
        abort_unless(file_exists($path), 404);
        return response()->download($path, 'offer-letter-' . $application->id . '.pdf');
    })->name('admin.offer-letter.download');
    Route::get('/document-types',                  [DocumentTypeController::class, 'index'])->name('document-types');
    Route::post('/document-types',                 [DocumentTypeController::class, 'store'])->name('document-types.store');
    Route::put('/document-types/{documentType}',   [DocumentTypeController::class, 'update'])->name('document-types.update');
    Route::delete('/document-types/{documentType}',[DocumentTypeController::class, 'destroy'])->name('document-types.destroy');

    Route::get('/settings',  [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings');
    Route::post('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');

    Route::get('/programs',                 [ProgramController::class, 'index'])->name('programs');
    Route::get('/programs/create',          [ProgramController::class, 'create'])->name('programs.create');
    Route::post('/programs',                [ProgramController::class, 'store'])->name('programs.store');
    Route::get('/programs/{program}/edit',  [ProgramController::class, 'edit'])->name('programs.edit');
    Route::put('/programs/{program}',       [ProgramController::class, 'update'])->name('programs.update');
    Route::delete('/programs/{program}',    [ProgramController::class, 'destroy'])->name('programs.destroy');
});
