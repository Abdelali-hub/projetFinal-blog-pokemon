<?php
use App\Http\Controllers\ProduitController;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminPass;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

Route::middleware([AdminPass::class])->group(function () {
    Route::get('/produits', [ProduitController::class, 'index']);
    Route::get('/produit/create', [ProduitController::class, 'create']);
    Route::post('/produit/post', [ProduitController::class, 'store']);
    Route::get('/produit/edit/{id}', [ProduitController::class, 'edit']);
    Route::put('/produit/update/{id}', [ProduitController::class, 'update']);
    Route::delete('/produit/delete/{id}', [ProduitController::class, 'destroy']);
    // autre route qu'on veut bloquer
});

Route::get('/produits', [ProduitController::class, 'index']);

Route::get('/produit', [ProduitController::class, 'index'])->middleware([AdminPass::class]);

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
