<?php

use App\Models\User;
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


Route::view('/', 'home')
    ->middleware(['auth', 'verified'])
    ->name('home');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile.edit');

Route::get('user/{id}', function ($id) {
    $user = User::findOrFail($id);
    return view('user.show', ['user' => $user]);
})
    ->middleware(['auth'])
    ->name('user.show');

require __DIR__ . '/auth.php';
