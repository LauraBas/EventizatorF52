<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController; 

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





Route::get('/', function () {
    return view('welcome')->name('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


// Route::get('/events', function () {
//     return view('events');
// })->name('events');

Route::get('/user', function () {
    return view('user');
})->name('user');

Route::get('/admin', function () {
    return view('admin');
})->name('admin');

require __DIR__.'/auth.php';

Route::get('/events',  [\App\Http\Controllers\EventController::class, 'index'])->name('events');
Route::get('/events/{id}',  [\App\Http\Controllers\EventController::class, 'show']);
Route::put('update/{event}', [\App\Http\Controllers\EventController::class , 'update'])->name('update')->middleware('auth');
Route::get('edit/{id}',[\App\Http\Controllers\EventController::class , 'edit'])->name('edit')->middleware('auth');
Route::delete('delete/{id}', [\App\Http\Controllers\EventController::class , 'destroy'])->name('delete')->middleware('auth');
Route::post('enroll/{id}', [\App\Http\Controllers\UserController::class, 'enroll'])->name('enroll')->middleware('auth');
Route::post('unenroll/{id}', [\App\Http\Controllers\UserController::class, 'unenroll'])->name('unenroll')->middleware('auth');