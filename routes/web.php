<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CellController;
use App\Http\Controllers\AnimalController;
use App\Models\Animal;
use App\Models\Cell;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
// Главная страница, отображает список клеток и общую статистику.
Route::get('/', function () {
    $cells = Cell::all();
    $totalAnimals = Animal::count();
    return view('welcome', compact('cells', 'totalAnimals'));
})->name('home');

// Отображение списка клеток.
Route::get('/cells', [CellController::class, 'index'])->name('cells.index');
// Отображение информации о конкретном животном.
Route::get('/animals/{animal}', [AnimalController::class, 'show'])->name('animals.show');
// Отображение информации о конкретной клетке.
Route::get('/cells/{cell}', [CellController::class, 'show'])->name('cells.show');
// Отображение формы для создания клетки.
Route::get('/cellsadd', [CellController::class, 'create'])->name('cells.create')->middleware('auth');
// Сохранение новой клетки.
Route::post('/cells', [CellController::class, 'store'])->name('cells.store')->middleware('auth');

// Отображение формы для редактирования клетки.
Route::get('/cells/{cell}/edit', [CellController::class, 'edit'])->name('cells.edit')->middleware('auth');
// Обновление информации о клетке.
Route::post('/cells/{cell}', [CellController::class, 'update'])->name('cells.update')->middleware('auth');
// Удаление клетки.
Route::post('/cells/{cell}/delete', [CellController::class, 'destroy'])->name('cells.destroy')->middleware('auth');
// Отображение формы для создания животного.
Route::get('/animalsadd', [AnimalController::class, 'create'])->name('animals.create')->middleware('auth');
// Сохранение нового животного.
Route::post('/animals', [AnimalController::class, 'store'])->name('animals.store')->middleware('auth');

// Отображение формы для редактирования животного.
Route::get('/animals/{animal}/edit', [AnimalController::class, 'edit'])->name('animals.edit')->middleware('auth');
// Обновление информации о животном.
Route::post('/animals/{animal}', [AnimalController::class, 'update'])->name('animals.update')->middleware('auth');
// Удаление животного.
Route::post('/animals/{animal}/delete', [AnimalController::class, 'destroy'])->name('animals.destroy')->middleware('auth');
