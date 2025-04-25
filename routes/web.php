<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;

/* AUTH VIEW UNAUTHENTICATED */
Route::get('/login', function () {/* display login page */
  return view('login');
})->name('login');

Route::get('/register', function () {/* display register page */
  return view('register');
})->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');/* executes logout function from authcontroller */

/* USER VIEW AUTHENTICATED */
Route::middleware(['auth'])->group(function () {/* redirects unauthenticated users to login */
  Route::get('/profile', [AuthController::class, 'index']);

  Route::get('/', [TaskController::class, 'index'])->name('tasks.index');/* tasks view */
  Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');/* tasks add */
  Route::patch('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');/* tasks update */
  Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');/* tasks remove */
});

/* AUTH METHOD */
Route::prefix('authentication')->group(function () {/* auth pages for methods */
  Route::post('/login', [AuthController::class, 'login']);
  Route::post('/register', [AuthController::class, 'register']);
  Route::delete('/user/{id}', [AuthController::class, 'deleteUser']);
  Route::put('/user/{id}', [AuthController::class, 'changePassword']);
});