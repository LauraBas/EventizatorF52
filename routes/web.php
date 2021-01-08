<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController; 

Route::get('/', function () {
    return view('welcome');
});

Route::get('/',[\App\Http\Controllers\EventController::class, 'highlighted'])->name('home');
Route::get('/events',  [\App\Http\Controllers\EventController::class, 'index'])->name('events');
Route::get('/events/{id}',  [\App\Http\Controllers\EventController::class, 'show']);


require __DIR__.'/auth.php';
Route::post('enroll/{id}', [\App\Http\Controllers\UserController::class, 'enroll'])->name('enroll')->middleware('auth');
Route::post('unenroll/{id}', [\App\Http\Controllers\UserController::class, 'unenroll'])->name('unenroll')->middleware('auth');
Route::get('/user', [\App\Http\Controllers\UserController::class, 'profile'])->name('profile')->middleware('auth');


Route::get('/event/create', function () {
    return view('create');
})->middleware(['admin']);


Route::get('/dashboard',  [\App\Http\Controllers\AdminController::class, 'indexDashboard'])->name('dashboard')->middleware(['admin']);
Route::put('event/update/{event}', [\App\Http\Controllers\EventController::class , 'update'])->name('update')->middleware('admin');
Route::get('event/edit/{id}',[\App\Http\Controllers\EventController::class , 'edit'])->name('edit')->middleware('admin');
Route::delete('event/delete/{id}', [\App\Http\Controllers\EventController::class , 'destroy'])->name('delete')->middleware('admin');
Route::post('event/store', [\App\Http\Controllers\EventController::class, 'store'])->name('store')->middleware('admin');
Route::get('/event/{id}/users', [\App\Http\Controllers\AdminController::class, 'participants'])->name('participants')->middleware('admin');


