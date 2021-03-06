<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PassengerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::prefix('car')->group(function () {
        Route::get('/', [CarController::class, 'index'])->name('car.index');

        Route::get('add', [CarController::class, 'addForm'])->name('car.add')->middleware('admin-staff-role');
        Route::post('add', [CarController::class, 'saveAdd']);

        Route::get('remove/{id}', [CarController::class, 'remove'])->name('car.remove')->middleware('admin-staff-role');

        Route::get('edit/{id}', [CarController::class, 'editForm'])->name('car.edit')->middleware('admin-staff-role');
        Route::post('edit/{id}', [CarController::class, 'saveEdit']);
    });

    Route::prefix('passenger')->group(function () {
        Route::get('/', [PassengerController::class, 'index'])->name('passenger.index');

        Route::get('add', [PassengerController::class, 'addForm'])->name('passenger.add')->middleware('admin-staff-role');
        Route::post('add', [PassengerController::class, 'saveAdd']);

        Route::get('remove/{id}', [PassengerController::class, 'remove'])->name('passenger.remove')->middleware('admin-staff-role');

        Route::get('edit/{id}', [PassengerController::class, 'editForm'])->name('passenger.edit')->middleware('admin-staff-role');
        Route::post('edit/{id}', [PassengerController::class, 'saveEdit']);
    });

    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');

        Route::get('add', [UserController::class, 'addForm'])->name('user.add')->middleware('admin-role');
        Route::post('add', [UserController::class, 'saveAdd']);

        Route::get('remove/{id}', [UserController::class, 'remove'])->name('user.remove')->middleware('admin-role');

        Route::get('editRole/{id}', [UserController::class, 'editRole'])->name('user.editRole')->middleware('admin-role');
        Route::post('editRole/{id}', [UserController::class, 'saveRole']);

        Route::get('edit/{id}', [UserController::class, 'editForm'])->name('user.edit');
        Route::post('edit/{id}', [UserController::class, 'saveEdit']);
    });
});

Route::get('login', [LoginController::class, 'loginForm'])->name('login');
Route::post('login', [LoginController::class, 'postLogin']);
Route::any('logout', function () {
    Auth::logout();
    return redirect(route('login'));
});

// Route::any('forbidden', function () {
//     return "B???n kh??ng c?? quy???n truy c???p v??o ???????ng d???n n??y!";
// })->name('403');

Route::get('403', [UserController::class, 'page403'])->name('403');