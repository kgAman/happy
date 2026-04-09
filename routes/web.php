<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\OccupationController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\Admin\CasteController;
use App\Http\Controllers\Admin\GotraController;
use App\Http\Controllers\Admin\CountryCodeController;
use App\Http\Controllers\ProfileImportExportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;

Auth::routes([
    'verify' => true,
]);
Route::get('/privacy-policy', function () {
    return view('pages.privacy-policy'); 
});
Route::get('/terms-of-service', function () {
    return view('pages.terms');
});
Route::get('admin-otp', [LoginController::class, 'showOtpForm'])->name('otp.form');
Route::post('admin-otp', [LoginController::class, 'verifyOtp'])->name('otp.verify');

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
// Search Routes
Route::prefix('search')->group(function () {
    Route::get('/', [SearchController::class, 'index'])->name('search');
    Route::post('/', [SearchController::class, 'search'])->name('search');
    
    // AJAX endpoints
    Route::get('/filter-counts', [SearchController::class, 'getFilterCounts'])->name('search.filter.counts');
    Route::get('/caste-options/{religion}', [SearchController::class, 'getCasteOptions'])->name('search.caste.options');
});

// Profiles
Route::prefix('profiles')->name('profiles.')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::get('/{id}', [ProfileController::class, 'show'])->name('show');
    Route::post('/{id}/connect', [ProfileController::class, 'connect'])->name('connect')->middleware('auth');
    Route::post('/{id}/shortlist', [ProfileController::class, 'shortlist'])->name('shortlist')->middleware('auth');
});

// Contact
Route::prefix('contact')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('contact');
    Route::post('/send', [ContactController::class, 'store'])->name('contact.store');
});

// Static Pages
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');
Route::get('/terms', [HomeController::class, 'terms'])->name('terms');
Route::get('/success-stories', [HomeController::class, 'successStories'])->name('success-stories');

// Dashboard (Protected)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/matches', [ProfileController::class, 'matches'])->name('matches');
    Route::get('/shortlisted', [ProfileController::class, 'shortlisted'])->name('shortlisted');
    Route::get('/messages', [ProfileController::class, 'messages'])->name('messages');
});


Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function(){
    
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    
    // USERS
    Route::resource('users', UserController::class);
    
    // ROLES
    Route::resource('roles', RoleController::class);

    // PERMISSIONS
    Route::resource('permissions', PermissionController::class)->only(['index','create','store','destroy']);
    
    // PROFILES
    Route::get('/profiles/export', [ProfileImportExportController::class, 'export'])->name('export');
    Route::post('/profiles/import', [ProfileImportExportController::class, 'import'])->name('import');
    Route::resource('profiles', ProfileController::class);
    
    
    // Upload images using Dropzone
    Route::post('/profiles/upload-image', [ProfileController::class, 'uploadImage'])->name('profiles.upload-image');

    Route::resource('educations', EducationController::class);
    Route::resource('occupations', OccupationController::class);
    Route::get('areas/import/form', [AreaController::class, 'importForm'])->name('areas.import.form');
    Route::post('areas/import', [AreaController::class, 'import'])->name('areas.import');
    Route::get('areas/export', [AreaController::class, 'export'])->name('areas.export');
    Route::resource('areas', AreaController::class);
    Route::resource('castes', CasteController::class);
    Route::resource('gotras', GotraController::class);
    Route::resource('country-codes', CountryCodeController::class);
    

});