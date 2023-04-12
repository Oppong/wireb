<?php

use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Login;
use App\Http\Livewire\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Register;


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

Route::get('/register', Register::class);
Route::get('/login', Login::class);
Route::get('/dashboard', Dashboard::class);
Route::get('/profile', Profile::class);

