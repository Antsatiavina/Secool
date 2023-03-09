<?php
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('accueil');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Etudiant crud 
Route::get('/etudiant_list', [EtudiantController::class, 'index'])->name('etudiant_list');
Route::post('/ajouter_etudiant', [EtudiantController::class, 'insert'])->name('ajouter_etudiant');
Route::get('/supprimer/{id}', [EtudiantController::class, 'delete']);
Route::post('/modifier/{id}', [EtudiantController::class, 'modify']);
require __DIR__.'/auth.php';
