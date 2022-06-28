<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MyScheduleController;
use App\Http\Controllers\StaffSchedulerController;

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

    Route::middleware('role:client')
        ->prefix('/my-schedule')
        ->group(function () {
            Route::get('/', [MyScheduleController::class, 'index'])
                ->name('my-schedule');

            Route::get('/create', [MyScheduleController::class, 'create'])
                ->name('my-schedule.create');

            Route::get('/{scheduler}/edit', [MyScheduleController::class, 'edit'])
                ->name('my-schedule.edit');

            Route::post('/', [MyScheduleController::class, 'store'])
                ->name('my-schedule.store');

            Route::put('/{scheduler}', [MyScheduleController::class, 'update'])
                ->name('my-schedule.update');

            Route::delete('/{scheduler}', [MyScheduleController::class, 'destroy'])
                ->name('my-schedule.destroy');
        });

    Route::middleware('role:staff')->group(function () {
        Route::get('/staff-scheduler', [StaffSchedulerController::class, 'index'])
            ->name('staff-scheduler.index');
    });

    Route::middleware('role:admin')->group(function () {
        Route::get('/users', [UsersController::class, 'index'])
            ->name('users.index');
    });

});

require __DIR__.'/auth.php';
