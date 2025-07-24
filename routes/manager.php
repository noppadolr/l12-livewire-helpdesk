<?php


use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

//Route::get('/', function () {
//    return view('welcome');
//})->name('home');

//Route::view('/', 'admin.admin-dashboard')->name('dashboard');
//    ->middleware(['auth', 'verified'])
//    ->name('dashboard');



Route::middleware(['auth', 'role:manager','status'])->group(function () {
    Route::view('/', 'manager.manager-dashboard')->name('dashboard');
});
