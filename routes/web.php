<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ActivitiesController;
use App\Http\Controllers\Admin\AdminAboutController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\BackEndController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CookiesController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\HomeApplicationController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TeamsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Routes du Tableau de Bord (Protégées par auth)
|--------------------------------------------------------------------------
*/
Route::prefix('dashboard')->middleware('auth')->group(function () {
    // Routes du profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // Pages secondaires du dashboard
    Route::get('/about', [AdminAboutController::class, 'index'])->name('dashboard.about');
    Route::get('/contact', [BackEndController::class, 'contact'])->name('dashboard.contact');
    Route::get('/expert', [BackEndController::class, 'expert'])->name('dashboard.expert');
    Route::get('/activities', [\App\Http\Controllers\Admin\ActivitiesController::class, 'index'])->name('dashboard.activities');
    Route::get('/accueil', [AdminHomeController::class, 'index'])->name('dashboard.accueil');
    Route::get('/actualities', [\App\Http\Controllers\Admin\NewsController::class, 'index'])->name('dashboard.actualities');


    // Page principale du dashboard = Analytics
    Route::get('/', [CookiesController::class, 'dashboard'])->name('dashboard.homepage');

    // Routes Analytics
    Route::prefix('analytics')->name('analytics.')->group(function () {
        Route::get('/', [CookiesController::class, 'dashboard'])->name('dashboard');
        Route::get('/export', [CookiesController::class, 'export'])->name('export');
    });

    // Routes CRUD pour les actualités
    Route::prefix('news')->name('news.')->group(function () {
        Route::get('/create', [\App\Http\Controllers\Admin\NewsController::class, 'create'])->name('create');
        Route::post('/', [\App\Http\Controllers\Admin\NewsController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [\App\Http\Controllers\Admin\NewsController::class, 'edit'])->name('edit');
        Route::put('/{id}', [\App\Http\Controllers\Admin\NewsController::class, 'update'])->name('update');
        Route::delete('/{id}', [\App\Http\Controllers\Admin\NewsController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/toggle-status', [\App\Http\Controllers\Admin\NewsController::class, 'toggleStatus'])->name('toggle-status');
    });

    // Routes CRUD pour les activités
    Route::prefix('activities')->name('activities.')->group(function () {
        // Page Content
        Route::put('/page-content', [\App\Http\Controllers\Admin\ActivitiesController::class, 'updatePageContent'])->name('update-page-content');

        // Themes
        Route::post('/themes', [\App\Http\Controllers\Admin\ActivitiesController::class, 'storeTheme'])->name('store-theme');
        Route::put('/themes/{id}', [\App\Http\Controllers\Admin\ActivitiesController::class, 'updateTheme'])->name('update-theme');
        Route::delete('/themes/{id}', [\App\Http\Controllers\Admin\ActivitiesController::class, 'deleteTheme'])->name('delete-theme');

        // Services
        Route::post('/services', [\App\Http\Controllers\Admin\ActivitiesController::class, 'storeService'])->name('store-service');
        Route::put('/services/{id}', [\App\Http\Controllers\Admin\ActivitiesController::class, 'updateService'])->name('update-service');
        Route::delete('/services/{id}', [\App\Http\Controllers\Admin\ActivitiesController::class, 'deleteService'])->name('delete-service');

        // Geographic Coverage
        Route::put('/geographic-coverage', [\App\Http\Controllers\Admin\ActivitiesController::class, 'updateGeographicCoverage'])->name('update-geographic-coverage');

        // Testimonials
        Route::post('/testimonials', [\App\Http\Controllers\Admin\ActivitiesController::class, 'storeTestimonial'])->name('store-testimonial');
        Route::put('/testimonials/{id}', [\App\Http\Controllers\Admin\ActivitiesController::class, 'updateTestimonial'])->name('update-testimonial');
        Route::delete('/testimonials/{id}', [\App\Http\Controllers\Admin\ActivitiesController::class, 'deleteTestimonial'])->name('delete-testimonial');
    });

    // Routes CRUD pour la page d'accueil
    Route::prefix('accueil')->name('dashboard.accueil.')->group(function () {
        // Slides
        Route::prefix('slides')->name('slides.')->group(function () {
            Route::post('/store', [AdminHomeController::class, 'storeSlide'])->name('store');
            Route::put('/{id}/update', [AdminHomeController::class, 'updateSlide'])->name('update');
            Route::delete('/{id}/delete', [AdminHomeController::class, 'deleteSlide'])->name('delete');
        });

        // À propos
        Route::put('/about/update', [AdminHomeController::class, 'updateAbout'])->name('about.update');

        // Chiffres clés
        Route::put('/keynumbers/update', [AdminHomeController::class, 'updateKeyNumbers'])->name('keynumbers.update');

        // Stats
        Route::prefix('stats')->name('stats.')->group(function () {
            Route::post('/store', [AdminHomeController::class, 'storeStat'])->name('store');
            Route::put('/{id}/update', [AdminHomeController::class, 'updateStat'])->name('update');
            Route::delete('/{id}/delete', [AdminHomeController::class, 'deleteStat'])->name('delete');
            Route::get('/{id}/toggle', [AdminHomeController::class, 'toggleStatStatus'])->name('toggle');
        });

        // Recrutement
        Route::put('/recruitment/update', [AdminHomeController::class, 'updateRecruitment'])->name('recruitment.update');
    });

    // Routes CRUD pour la page About
    Route::prefix('about')->name('dashboard.about.')->group(function () {
        Route::get('/manage', [AdminAboutController::class, 'index'])->name('manage');

        // Section principale
        Route::put('/main-section', [AdminAboutController::class, 'updateMainSection'])->name('main-section.update');

        // Accordion
        Route::post('/accordion', [AdminAboutController::class, 'storeAccordionItem'])->name('accordion.store');
        Route::get('/accordion/{id}/edit', [AdminAboutController::class, 'getAccordionItem'])->name('accordion.edit');
        Route::put('/accordion/{id}', [AdminAboutController::class, 'updateAccordionItem'])->name('accordion.update');
        Route::delete('/accordion/{id}', [AdminAboutController::class, 'deleteAccordionItem'])->name('accordion.delete');

        // Transition
        Route::put('/transition-section', [AdminAboutController::class, 'updateTransitionSection'])->name('transition-section.update');

        // Team
        Route::post('/team', [AdminAboutController::class, 'storeTeamMember'])->name('team.store');
        Route::get('/team/{id}/edit', [AdminAboutController::class, 'getTeamMember'])->name('team.edit');
        Route::put('/team/{id}', [AdminAboutController::class, 'updateTeamMember'])->name('team.update');
        Route::delete('/team/{id}', [AdminAboutController::class, 'deleteTeamMember'])->name('team.delete');
    });
});

/*
|--------------------------------------------------------------------------
| Routes d'Authentification
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| Routes Frontend (Publiques)
|--------------------------------------------------------------------------
*/
// Accueil et candidature
Route::get('/', [FrontEndController::class, 'index'])->name('front.home');
Route::post('/home-application', [HomeApplicationController::class, 'store'])->name('home.application.store');

// Pages statiques
Route::get('/about', [AboutController::class, 'index'])->name('front.about');
Route::get('/activities', [ActivitiesController::class, 'index'])->name('front.activities');
Route::get('/actualites', [NewsController::class, 'index'])->name('front.news');
Route::get('/team-details', [TeamController::class, 'index'])->name('front.team.details');
Route::get('/contact', [ContactController::class, 'index'])->name('front.contact');
Route::get('/team', [TeamsController::class, 'index'])->name('front.teams');

// Formulaires contact
Route::post('/contact/application', [ContactController::class, 'storeApplication'])->name('contact.application.store');
Route::post('/contact/quote', [ContactController::class, 'storeQuote'])->name('contact.quote.store');

// Cookies
Route::post('/cookies/accept', [CookiesController::class, 'accept'])->name('cookies.accept');
Route::post('/cookies/decline', [CookiesController::class, 'decline'])->name('cookies.decline');
Route::get('/cookies/status', [CookiesController::class, 'status'])->name('cookies.status');


