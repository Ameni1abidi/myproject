<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StagiaireController;
use App\Http\Controllers\TuteurController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\StagiaireDashboardController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Admin\AffectationController;
use App\Http\Controllers\TuteurDashboardController;
use App\Http\Controllers\EvaluationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Protected Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Protected Routes by Authentication
Route::middleware('auth')->group(function () {
    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User Management (protected by "admin" role)
    Route::middleware(['role_or_permission:admin|manage users'])->group(function () {
        Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::PATCH('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
        
        Route::get('/admin/permissions', [PermissionController::class, 'index'])->name('admin.permissions.index');
        Route::get('/admin/permissions/{user}/edit', [PermissionController::class, 'edit'])->name('admin.permissions.edit');
        Route::post('/admin/permissions/{user}/update', [PermissionController::class, 'update'])->name('admin.permissions.update');
        
        Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
            Route::get('/affectations', [AffectationController::class, 'index'])->name('admin.affectations.index');
            Route::post('/affecter', [AffectationController::class, 'store'])->name('admin.affectations.store');
        });
    
    Route::resource('stages', StageController::class);
    Route::get('/stages/create', [StageController::class, 'create'])->name('stages.create');
    Route::get('/stages', [StageController::class, 'index'])->name('stages.index');
    Route::get('/stages/{id}', [StageController::class, 'show'])->name('stages.show');

        Route::resource('stagiaires', StagiaireController::class);
        Route::get('/stagiaires', [StagiaireController::class, 'index'])->name('stagiaires.index');
        Route::get('/stagiaires/create', [StagiaireController::class, 'create'])->name('stagiaires.create');
        Route::get('/stagiaires/{stagiaire}', [StagiaireController::class, 'show'])->name('stagiaires.show');
        Route::get('/stagiaires/{stagiaire}/edit', [StagiaireController::class, 'edit'])->name('stagiaires.edit');
        Route::patch('/stagiaires/{stagiaire}', [StagiaireController::class, 'update'])->name('stagiaires.update');
        Route::patch('/admin/stagiaires/{stagiaire}/assign-tuteur', [AdminController::class, 'assignTuteur'])->name('admin.stagiaires.assignTuteur');
        Route::get('/stagiaires/export-excel', [StagiaireController::class, 'exportExcel'])->name('stagiaires.exportExcel');
        Route::get('/stagiaires/export-pdf', [StagiaireController::class, 'exportPDF'])->name('stagiaires.exportPDF');

        Route::prefix('tuteurs')->group(function () {
            Route::get('/', [TuteurController::class, 'index'])->name('tuteurs.index');
            Route::get('/create', [TuteurController::class, 'create'])->name('tuteurs.create');
            Route::post('/', [TuteurController::class, 'store'])->name('tuteurs.store');
            Route::get('/{tuteur}', [TuteurController::class, 'show'])->name('tuteurs.show');
            Route::get('/{tuteur}/edit', [TuteurController::class, 'edit'])->name('tuteurs.edit');
            Route::put('/{tuteur}', [TuteurController::class, 'update'])->name('tuteurs.update');
            Route::delete('/{tuteur}', [TuteurController::class, 'destroy'])->name('tuteurs.destroy');
        });
    });

    // Tuteur Dashboard
    Route::middleware(['auth', 'role:agent'])->group(function () {
        Route::get('/stagiaire/{stage}', [TuteurDashboardController::class, 'showStagiaire'])->name('stagiaire_show');
        Route::get('/dashboard_tuteur', [TuteurDashboardController::class, 'dashboard'])->name('dashboard_tuteur');
        Route::post('/stagiaire/{stage}/ajouter-rapport', [TuteurDashboardController::class, 'ajouterRapport'])->name('stagiaire.ajouter_rapport');
        Route::post('/stagiaires/{stage}/evaluer', [TuteurDashboardController::class, 'evaluerStage'])->name('evaluer_stage');
        Route::post('/stages/{stage}/evaluations', [EvaluationController::class, 'store'])->name('evaluation.store');
        // Voir stagiaires affectés
    Route::get('/mes-stagiaires', [TuteurDashboardController::class, 'mesStagiaires'])->name('tuteur.mes_stagiaires');
    });
    

    // Stagiaire Dashboard
    Route::middleware(['auth','role:stagiaire'])->group(function () {
        Route::get('/dashboard_stagiaire', [StagiaireDashboardController::class, 'index'])->name('dashboard_stagiaire');
         // Voir ses stages
    Route::get('/mes-stages', [StagiaireDashboardController::class, 'mesStages'])->name('stagiaire.mes_stages');
    Route::get('/stagiaires/{stagiaire}/edit', [StagiaireController::class, 'edit'])->name('stagiaires.edit');
        Route::patch('/stagiaires/{stagiaire}', [StagiaireController::class, 'update'])->name('stagiaires.update');
        
    });
   
       
 // Exemple de route pour tester
Route::get('/admin/test-route', function () {
    return "La route de test fonctionne !";
})->name('admin.test.route');

    

    Route::middleware(['role_or_permission:admin|agent|stagiaire|manage stages'])->group(function () {
        Route::get('/stages', [StageController::class, 'index'])->name('stages.index');
        Route::get('/stages/{stage}', [StageController::class, 'show'])->name('stages.show');
        Route::get('/export-excel', [ExportController::class, 'exportExcel'])->name('export.excel');
        Route::get('/export-pdf', [ExportController::class, 'exportPDF'])->name('export.pdf');
    });


    
});

// Include Laravel Breeze authentication routes
require __DIR__.'/auth.php';
