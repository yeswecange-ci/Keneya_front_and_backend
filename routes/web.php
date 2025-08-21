<?php

use App\Http\Controllers\FrontEndController;
use Illuminate\Support\Facades\Route;

<<<<<<< HEAD
Route::get('/', function () {
    return view('home');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/news', function () {
    return view('news');
});

Route::get('/team-details', function () {
    return view('team-details');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/activities', function () {
    return view('activities');
});
=======

// Routes d'authentification (dashboard, profile)
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';

// Route d'accueil frontend
Route::get('/', [FrontEndController::class, 'index'])->name('front.home');

// Routes frontend supplémentaires
Route::get('/about', [FrontEndController::class, 'about'])->name('front.about');
Route::get('/activities', [FrontEndController::class, 'activities'])->name('front.activities');
Route::get('/contact', [FrontEndController::class, 'contact'])->name('front.contact');
Route::get('/news', [FrontEndController::class, 'news'])->name('front.news');
Route::get('/teams', [FrontEndController::class, 'teams'])->name('front.teams');
Route::get('/team-details', [FrontEndController::class, 'teamDetails'])->name('front.team.details');
>>>>>>> 853c7f9c741c7de018ab622eff7861193fd7bb29
