<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ActivitiesController;
use App\Http\Controllers\Admin\AdminAboutController;
use App\Http\Controllers\Admin\AdminHomeController;
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
    Route::get('/contact', [\App\Http\Controllers\Admin\ContactController::class, 'index'])->name('dashboard.contact');
    Route::get('/expert', [\App\Http\Controllers\Admin\ExpertController::class, 'index'])->name('dashboard.expert');
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

        // Key Numbers
        Route::post('/keynumbers', [\App\Http\Controllers\Admin\ActivitiesController::class, 'storeKeyNumber'])->name('store-keynumber');
        Route::put('/keynumbers/{id}', [\App\Http\Controllers\Admin\ActivitiesController::class, 'updateKeyNumber'])->name('update-keynumber');
        Route::delete('/keynumbers/{id}', [\App\Http\Controllers\Admin\ActivitiesController::class, 'deleteKeyNumber'])->name('delete-keynumber');
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

        // Partenaires
        Route::prefix('partners')->name('partners.')->group(function () {
            Route::put('/update', [AdminHomeController::class, 'updatePartners'])->name('update');
            Route::post('/items/store', [AdminHomeController::class, 'storePartnerItem'])->name('items.store');
            Route::put('/items/{id}/update', [AdminHomeController::class, 'updatePartnerItem'])->name('items.update');
            Route::delete('/items/{id}/delete', [AdminHomeController::class, 'deletePartnerItem'])->name('items.delete');
            Route::get('/items/{id}/toggle', [AdminHomeController::class, 'togglePartnerItemStatus'])->name('items.toggle');
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

        // FOOTER - Routes ajoutées
        Route::prefix('footer')->name('footer.')->group(function () {
            // Paramètres généraux
            Route::put('/settings/update', [AdminHomeController::class, 'updateFooterSettings'])->name('settings.update');

            // Colonnes
            Route::post('/columns/store', [AdminHomeController::class, 'storeFooterColumn'])->name('columns.store');
            Route::put('/columns/{id}/update', [AdminHomeController::class, 'updateFooterColumn'])->name('columns.update');
            Route::delete('/columns/{id}/delete', [AdminHomeController::class, 'deleteFooterColumn'])->name('columns.delete');
            Route::get('/columns/{id}/toggle', [AdminHomeController::class, 'toggleColumnStatus'])->name('columns.toggle');

            // Liens
            Route::post('/links/store', [AdminHomeController::class, 'storeFooterLink'])->name('links.store');
            Route::put('/links/{id}/update', [AdminHomeController::class, 'updateFooterLink'])->name('links.update');
            Route::delete('/links/{id}/delete', [AdminHomeController::class, 'deleteFooterLink'])->name('links.delete');
            Route::get('/links/{id}/toggle', [AdminHomeController::class, 'toggleLinkStatus'])->name('links.toggle');

            // Réseaux sociaux
            Route::post('/socials/store', [AdminHomeController::class, 'storeFooterSocial'])->name('socials.store');
            Route::put('/socials/{id}/update', [AdminHomeController::class, 'updateFooterSocial'])->name('socials.update');
            Route::delete('/socials/{id}/delete', [AdminHomeController::class, 'deleteFooterSocial'])->name('socials.delete');
            Route::get('/socials/{id}/toggle', [AdminHomeController::class, 'toggleSocialStatus'])->name('socials.toggle');
        });
    });

    // Ajoutez ce groupe APRÈS la route dashboard.contact
    Route::prefix('contact')->name('dashboard.contact.')->group(function () {
        Route::get('/application/{id}', [\App\Http\Controllers\Admin\ContactController::class, 'showApplication'])->name('show-application');
        Route::get('/quote/{id}', [\App\Http\Controllers\Admin\ContactController::class, 'showQuote'])->name('show-quote');
        Route::get('/download-cv/{id}', [\App\Http\Controllers\Admin\ContactController::class, 'downloadCv'])->name('download-cv');
        Route::post('/mark-read/{id}', [\App\Http\Controllers\Admin\ContactController::class, 'markAsRead'])->name('mark-read');
        Route::delete('/{id}', [\App\Http\Controllers\Admin\ContactController::class, 'destroy'])->name('destroy');
    });

    // Routes CRUD pour l'équipe expert
    Route::prefix('expert')->name('dashboard.expert.')->group(function () {
        // Team Leader - Accepter PUT et POST
        Route::match(['put', 'post'], '/update-leader', [\App\Http\Controllers\Admin\ExpertController::class, 'updateTeamLeader'])->name('update-leader');

        // Team Members
        Route::post('/store-member', [\App\Http\Controllers\Admin\ExpertController::class, 'storeTeamMember'])->name('store-member');
        Route::match(['put', 'post'], '/update-member/{id}', [\App\Http\Controllers\Admin\ExpertController::class, 'updateTeamMember'])->name('update-member');
        Route::delete('/delete-member/{id}', [\App\Http\Controllers\Admin\ExpertController::class, 'deleteTeamMember'])->name('delete-member');
    });

    // Routes CRUD pour la page About - CORRIGÉES
    Route::prefix('about')->name('dashboard.about.')->group(function () {
        Route::get('/manage', [AdminAboutController::class, 'index'])->name('manage');

        // Section principale
        Route::put('/main-section/update', [AdminAboutController::class, 'updateMainSection'])->name('main-section.update');

        // Accordion
        Route::post('/accordion/store', [AdminAboutController::class, 'storeAccordionItem'])->name('accordion.store');
        Route::get('/accordion/{id}/edit', [AdminAboutController::class, 'getAccordionItem'])->name('accordion.edit');
        Route::put('/accordion/{id}/update', [AdminAboutController::class, 'updateAccordionItem'])->name('accordion.update');
        Route::delete('/accordion/{id}/delete', [AdminAboutController::class, 'deleteAccordionItem'])->name('accordion.delete');

        // Transition
        Route::put('/transition-section/update', [AdminAboutController::class, 'updateTransitionSection'])->name('transition-section.update');

        // Team
        Route::post('/team/store', [AdminAboutController::class, 'storeTeamMember'])->name('team.store');
        Route::get('/team/{id}/edit', [AdminAboutController::class, 'getTeamMember'])->name('team.edit');
        Route::put('/team/{id}/update', [AdminAboutController::class, 'updateTeamMember'])->name('team.update');
        Route::delete('/team/{id}/delete', [AdminAboutController::class, 'deleteTeamMember'])->name('team.delete');
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
