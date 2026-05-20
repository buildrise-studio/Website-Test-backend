<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProjetController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\TemoignageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Public\PublicProjetController;
use App\Http\Controllers\Public\PublicServiceController;
use App\Http\Controllers\Public\PublicFaqController;
use App\Http\Controllers\Public\PublicTemoignageController;
use App\Http\Controllers\Public\ContactController;

/*
|--------------------------------------------------------------------------
| API Routes publiques
|--------------------------------------------------------------------------
*/
Route::prefix('v1')->group(function () {

    // Projets publics
    Route::get('/projets',           [PublicProjetController::class, 'index']);
    Route::get('/projets/{id}',      [PublicProjetController::class, 'show']);

    // Services publics
    Route::get('/services',          [PublicServiceController::class, 'index']);
    Route::get('/services/{slug}',   [PublicServiceController::class, 'show']);

    // FAQ publique
    Route::get('/faq',               [PublicFaqController::class, 'index']);

    // Témoignages publics
    Route::get('/temoignages',       [PublicTemoignageController::class, 'index']);

    // Contact
    Route::post('/contact',          [ContactController::class, 'store']);

    /*
    |----------------------------------------------------------------------
    | Routes Admin — Authentification
    |----------------------------------------------------------------------
    */
    Route::prefix('admin')->group(function () {

        // Login / Logout (pas besoin d'auth)
        Route::post('/login',  [AuthController::class, 'login']);
        Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
        Route::get('/me',      [AuthController::class, 'me'])->middleware('auth:sanctum');

        // Routes protégées par Sanctum
        Route::middleware(['auth:sanctum'])->group(function () {

            // Dashboard stats
            Route::get('/stats', [DashboardController::class, 'stats']);

            // Projets CRUD
            Route::apiResource('/projets',     ProjetController::class);
            Route::patch('/projets/{id}/ordre',[ProjetController::class, 'updateOrdre']);

            // Services CRUD
            Route::apiResource('/services',    ServiceController::class);

            // FAQ CRUD
            Route::apiResource('/faq',         FaqController::class);
            Route::patch('/faq/{id}/ordre',    [FaqController::class, 'updateOrdre']);

            // Messages
            Route::get('/messages',                    [MessageController::class, 'index']);
            Route::get('/messages/{id}',               [MessageController::class, 'show']);
            Route::patch('/messages/{id}/marquer-lu',  [MessageController::class, 'marquerLu']);
            Route::delete('/messages/{id}',            [MessageController::class, 'destroy']);

            // Témoignages CRUD
            Route::apiResource('/temoignages', TemoignageController::class);
            Route::patch('/temoignages/{id}/valider', [TemoignageController::class, 'valider']);
        });
    });
});

// Alias sans version pour compatibilité frontend
Route::prefix('')->group(function () {
    Route::get('/projets',     [PublicProjetController::class, 'index']);
    Route::get('/services',    [PublicServiceController::class, 'index']);
    Route::get('/faq',         [PublicFaqController::class, 'index']);
    Route::get('/temoignages', [PublicTemoignageController::class, 'index']);
    Route::post('/contact',    [ContactController::class, 'store']);

    Route::post('/admin/login',  [AuthController::class, 'login']);
    Route::post('/admin/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

    Route::middleware(['auth:sanctum'])->prefix('admin')->group(function () {
        Route::get('/stats',              [DashboardController::class, 'stats']);
        Route::apiResource('/projets',    ProjetController::class);
        Route::apiResource('/services',   ServiceController::class);
        Route::apiResource('/faq',        FaqController::class);
        Route::get('/messages',           [MessageController::class, 'index']);
        Route::get('/messages/{id}',      [MessageController::class, 'show']);
        Route::patch('/messages/{id}/marquer-lu', [MessageController::class, 'marquerLu']);
        Route::delete('/messages/{id}',   [MessageController::class, 'destroy']);
        Route::apiResource('/temoignages', TemoignageController::class);
        Route::patch('/temoignages/{id}/valider', [TemoignageController::class, 'valider']);
    });
});