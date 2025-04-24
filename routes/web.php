<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::get('/login', function () {/* display login page */
  return view('login');
})->name('login');/* added ->name to have a route name */

Route::get('/register', function () {/* display register page */
  return view('register');
})->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');/* executes logout function from authcontroller */

Route::prefix('authentication')->group(function () {/* auth pages for method POST */
  Route::post('/user', [AuthController::class, 'index']);
  Route::post('/login', [AuthController::class, 'login']);
  Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware(['auth'])->group(function () {/* redirects unauthenticated users to login */
  Route::get('/', function () {
    return view('home');
  });
});