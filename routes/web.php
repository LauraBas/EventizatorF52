<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/events', function () {
    return view('events');
})->name('events');

Route::get('/user', function () {
    return view('user');
})->name('user');

Route::get('/admin', function () {
    return view('admin');
})->name('admin');

require __DIR__.'/auth.php';
