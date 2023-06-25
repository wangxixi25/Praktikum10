<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;

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
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {

    // Route home
    Route::get('home', [HomeController::class, 'index'])->name('home');

    // Route Profile
    Route::get('profile', ProfileController::class)->name('profile');

    // Employe
    Route::resource('employees', EmployeeController::class);

});


// Route::get('/default', function () {
//     return view('default');
// });


Auth::routes();

