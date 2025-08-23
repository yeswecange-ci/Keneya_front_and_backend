<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\BackEndController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\Admin\HomeController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('dashboard')->middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/', [BackEndController::class, 'index'])->name('dashboard.homepage');
    Route::get('/about', [BackEndController::class, 'about'])->name('dashboard.about');
    Route::get('/contact', [BackEndController::class, 'contact'])->name('dashboard.contact');
    Route::get('/activities', [BackEndController::class, 'activities'])->name('dashboard.activities');
    Route::get('/actualities', [BackEndController::class, 'actualities'])->name('dashboard.actualities');
    Route::get('/accueil', [BackEndController::class, 'accueil'])->name('dashboard.accueil');
});

require __DIR__.'/auth.php';

// Route d'accueil frontend
Route::get('/', [FrontEndController::class, 'index'])->name('front.home');

// Routes frontend supplémentaires
Route::get('/about', [FrontEndController::class, 'about'])->name('front.about');
Route::get('/activities', [FrontEndController::class, 'activities'])->name('front.activities');
Route::get('/contact', [FrontEndController::class, 'contact'])->name('front.contact');
Route::get('/news', [FrontEndController::class, 'news'])->name('front.news');
Route::get('/teams', [FrontEndController::class, 'teams'])->name('front.teams');
Route::get('/team-details', [FrontEndController::class, 'teamDetails'])->name('front.team.details');

