<?php

use App\Http\Controllers\MyScheduleController;
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

Route::view('about', 'about');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/my-schedule', [MyScheduleController::class, 'index'])
        ->name('my-schedule');

    Route::get('/my-schedule/create', [MyScheduleController::class, 'create'])
        ->name('my-schedule.create');

    Route::get('/my-schedule/{scheduler}/edit', [MyScheduleController::class, 'edit'])
        ->name('my-schedule.edit');

    Route::post('/my-schedule', [MyScheduleController::class, 'store'])
        ->name('my-schedule.store');

    Route::put('/my-schedule/{scheduler}', [MyScheduleController::class, 'update'])
        ->name('my-schedule.update');



    Route::delete('/my-schedule/{scheduler}', [MyScheduleController::class, 'destroy'])
        ->name('my-schedule.destroy');

});

require __DIR__.'/auth.php';
