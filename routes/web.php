<?php

use App\Http\Controllers\NotificacionController;
use Livewire\Livewire;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VacanteController;

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
// Notificaciones
Route::get('/notificaciones', NotificacionController::class)->middleware(['auth', 'verified', 'rol.reclutador'])->name('notificaciones.index');

Route::get('/', function () {
    return view('welcome');
})->name('home');
// Ruta para el index de reclutador
Route::get('/dashboard',[VacanteController::class,'index'])->middleware(['auth', 'verified', 'rol.reclutador'])->name('vacantes.index'); // Ruta inicio
Route::get('/vacantes/create',[VacanteController::class,'create'])->middleware(['auth', 'verified'])->name('vacantes.create'); // Ruta para crear vacantes
Route::get('/vacantes/{vacante}/edit',[VacanteController::class,'edit'])->middleware(['auth', 'verified'])->name('vacantes.edit'); // Ruta para editar vacantes
Route::get('/vacantes/{vacante}',[VacanteController::class,'show'])->name('vacantes.show'); // Ruta para mostrar vacantes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';