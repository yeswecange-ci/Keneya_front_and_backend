<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ActivitiesController;
use App\Http\Controllers\Admin\AdminAboutController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\HomeServicesSectionController;
use App\Http\Controllers\Admin\HomeTargetAudienceSectionController;
use App\Http\Controllers\Admin\HomeUniqueApproachSectionController;
use App\Http\Controllers\Admin\HomeTeamSectionController;
use App\Http\Controllers\Admin\HomeExpertSpaceSectionController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CookiesController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\HomeApplicationController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TeamsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Routes de Changement de Langue
|--------------------------------------------------------------------------
*/
Route::post('/locale/change', [LocaleController::class, 'changeLocale'])->name('locale.change');
Route::get('/locale/current', [LocaleController::class, 'getCurrentLocale'])->name('locale.current');

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
        Route::get('/keynumbers/{id}/edit', [\App\Http\Controllers\Admin\ActivitiesController::class, 'editKeyNumber'])->name('edit-keynumber');
        Route::put('/keynumbers/{id}', [\App\Http\Controllers\Admin\ActivitiesController::class, 'updateKeyNumber'])->name('update-keynumber');
        Route::delete('/keynumbers/{id}', [\App\Http\Controllers\Admin\ActivitiesController::class, 'deleteKeyNumber'])->name('delete-keynumber');

        // Page Content
        Route::put('/page-content', [\App\Http\Controllers\Admin\ActivitiesController::class, 'updatePageContent'])->name('update-page-content');

        // Themes
        Route::post('/themes', [\App\Http\Controllers\Admin\ActivitiesController::class, 'storeTheme'])->name('store-theme');
        Route::get('/themes/{id}/edit', [\App\Http\Controllers\Admin\ActivitiesController::class, 'editTheme'])->name('edit-theme');
        Route::put('/themes/{id}', [\App\Http\Controllers\Admin\ActivitiesController::class, 'updateTheme'])->name('update-theme');
        Route::delete('/themes/{id}', [\App\Http\Controllers\Admin\ActivitiesController::class, 'deleteTheme'])->name('delete-theme');

        // Services
        Route::post('/services', [\App\Http\Controllers\Admin\ActivitiesController::class, 'storeService'])->name('store-service');
        Route::get('/services/{id}/edit', [\App\Http\Controllers\Admin\ActivitiesController::class, 'editService'])->name('edit-service');
        Route::put('/services/{id}', [\App\Http\Controllers\Admin\ActivitiesController::class, 'updateService'])->name('update-service');
        Route::delete('/services/{id}', [\App\Http\Controllers\Admin\ActivitiesController::class, 'deleteService'])->name('delete-service');

        // Geographic Coverage
        Route::put('/geographic-coverage', [\App\Http\Controllers\Admin\ActivitiesController::class, 'updateGeographicCoverage'])->name('update-geographic-coverage');

        // Testimonials
        Route::post('/testimonials', [\App\Http\Controllers\Admin\ActivitiesController::class, 'storeTestimonial'])->name('store-testimonial');
        Route::get('/testimonials/{id}/edit', [\App\Http\Controllers\Admin\ActivitiesController::class, 'editTestimonial'])->name('edit-testimonial');
        Route::put('/testimonials/{id}', [\App\Http\Controllers\Admin\ActivitiesController::class, 'updateTestimonial'])->name('update-testimonial');
        Route::delete('/testimonials/{id}', [\App\Http\Controllers\Admin\ActivitiesController::class, 'deleteTestimonial'])->name('delete-testimonial');

        // Countries
        Route::post('/countries', [\App\Http\Controllers\Admin\ActivitiesController::class, 'storeCountry'])->name('store-country');
        Route::get('/countries/{id}/edit', [\App\Http\Controllers\Admin\ActivitiesController::class, 'editCountry'])->name('edit-country');
        Route::put('/countries/{id}', [\App\Http\Controllers\Admin\ActivitiesController::class, 'updateCountry'])->name('update-country');
        Route::delete('/countries/{id}', [\App\Http\Controllers\Admin\ActivitiesController::class, 'deleteCountry'])->name('delete-country');
        Route::post('/countries/bulk-colors', [\App\Http\Controllers\Admin\ActivitiesController::class, 'updateBulkColors'])->name('bulk-colors');
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

    // Routes pour les nouvelles sections de la page d'accueil
    Route::prefix('home')->name('dashboard.home.')->group(function () {
        // Section Services
        Route::prefix('services')->name('services.')->group(function () {
            Route::get('/', [HomeServicesSectionController::class, 'index'])->name('index');
            Route::put('/update', [HomeServicesSectionController::class, 'update'])->name('update');
        });

        // Section Public Cible
        Route::prefix('target-audience')->name('target-audience.')->group(function () {
            Route::get('/', [HomeTargetAudienceSectionController::class, 'index'])->name('index');
            Route::put('/update', [HomeTargetAudienceSectionController::class, 'update'])->name('update');
            Route::post('/items/store', [HomeTargetAudienceSectionController::class, 'storeItem'])->name('items.store');
            Route::put('/items/{id}/update', [HomeTargetAudienceSectionController::class, 'updateItem'])->name('items.update');
            Route::get('/items/{id}/toggle', [HomeTargetAudienceSectionController::class, 'toggleItem'])->name('items.toggle');
            Route::delete('/items/{id}/delete', [HomeTargetAudienceSectionController::class, 'destroyItem'])->name('items.delete');
        });

        // Section Approche Unique
        Route::prefix('unique-approach')->name('unique-approach.')->group(function () {
            Route::get('/', [HomeUniqueApproachSectionController::class, 'index'])->name('index');
            Route::put('/update', [HomeUniqueApproachSectionController::class, 'update'])->name('update');
            Route::post('/items/store', [HomeUniqueApproachSectionController::class, 'storeItem'])->name('items.store');
            Route::put('/items/{id}/update', [HomeUniqueApproachSectionController::class, 'updateItem'])->name('items.update');
            Route::get('/items/{id}/toggle', [HomeUniqueApproachSectionController::class, 'toggleItem'])->name('items.toggle');
            Route::delete('/items/{id}/delete', [HomeUniqueApproachSectionController::class, 'destroyItem'])->name('items.delete');
        });

        // Section Équipe
        Route::prefix('team')->name('team.')->group(function () {
            Route::get('/', [HomeTeamSectionController::class, 'index'])->name('index');
            Route::put('/update', [HomeTeamSectionController::class, 'update'])->name('update');
        });

        // Section Espace Expert
        Route::prefix('expert-space')->name('expert-space.')->group(function () {
            Route::get('/', [HomeExpertSpaceSectionController::class, 'index'])->name('index');
            Route::put('/update', [HomeExpertSpaceSectionController::class, 'update'])->name('update');
        });
    });

    // Ajoutez ce groupe APRÈS la route dashboard.contact
    Route::prefix('contact')->name('dashboard.contact.')->group(function () {
        Route::get('/application/{id}', [\App\Http\Controllers\Admin\ContactController::class, 'showApplication'])->name('show-application');
        Route::get('/quote/{id}', [\App\Http\Controllers\Admin\ContactController::class, 'showQuote'])->name('show-quote');
        Route::get('/download-cv/{id}', [\App\Http\Controllers\Admin\ContactController::class, 'downloadCv'])->name('download-cv');
        Route::post('/mark-read/{id}', [\App\Http\Controllers\Admin\ContactController::class, 'markAsRead'])->name('mark-read');
        Route::post('/mark-unread/{id}', [\App\Http\Controllers\Admin\ContactController::class, 'markAsUnread'])->name('mark-unread');
        Route::post('/mark-multiple-read', [\App\Http\Controllers\Admin\ContactController::class, 'markMultipleRead'])->name('mark-multiple-read');
        Route::post('/delete-multiple', [\App\Http\Controllers\Admin\ContactController::class, 'deleteMultiple'])->name('delete-multiple');
        Route::get('/export', [\App\Http\Controllers\Admin\ContactController::class, 'export'])->name('export');
        Route::delete('/{id}', [\App\Http\Controllers\Admin\ContactController::class, 'destroy'])->name('destroy');
    });

    // Routes CRUD pour l'équipe expert
    Route::prefix('expert')->name('dashboard.expert.')->group(function () {
        // Team Leader
        Route::put('/update-leader', [\App\Http\Controllers\Admin\ExpertController::class, 'updateTeamLeader'])->name('update-leader');

        // Team Members
        Route::post('/store-member', [\App\Http\Controllers\Admin\ExpertController::class, 'storeTeamMember'])->name('store-member');
        Route::put('/update-member/{id}', [\App\Http\Controllers\Admin\ExpertController::class, 'updateTeamMember'])->name('update-member');
        Route::delete('/delete-member/{id}', [\App\Http\Controllers\Admin\ExpertController::class, 'deleteTeamMember'])->name('delete-member');

        // Expert Space Section
        Route::put('/update-expert-space', [\App\Http\Controllers\Admin\ExpertController::class, 'updateExpertSpaceSection'])->name('update-expert-space');
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
        Route::post('/team/reorder', [AdminAboutController::class, 'reorderTeamMembers'])->name('team.reorder');
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
Route::get('/activities/country/{code}', [\App\Http\Controllers\Admin\ActivitiesController::class, 'getCountryData'])->name('front.activities.country');
Route::get('/actualites', [NewsController::class, 'index'])->name('front.news');
Route::get('/actualites/{slug}', [NewsController::class, 'show'])->name('front.news.show');
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
