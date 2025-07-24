<?php


use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Position\Index;

//Route::get('/', function () {
//    return view('welcome');
//})->name('home');

//Route::view('/', 'admin.admin-dashboard')->name('dashboard');
//    ->middleware(['auth', 'verified'])
//    ->name('dashboard');



Route::middleware(['auth', 'role:admin','status'])->group(function () {
    Route::view('/', 'admin.admin-dashboard')->name('dashboard');
    Route::get('/position',Index::class)->name('position.index');
});
