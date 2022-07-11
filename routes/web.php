<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MyScheduleController;
use App\Http\Controllers\ImpersonateController;
use App\Http\Controllers\OpeningHoursController;
use App\Http\Controllers\UsersServicesController;
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

        Route::get('/staff-scheduler/{scheduler}/edit', [StaffSchedulerController::class, 'edit'])
            ->name('staff-scheduler.edit');

        Route::put('/staff-scheduler/{scheduler}', [StaffSchedulerController::class, 'update'])
            ->name('staff-scheduler.update');

        Route::delete('/staff-scheduler/{scheduler}', [StaffSchedulerController::class, 'destroy'])
            ->name('staff-scheduler.destroy');
    });

    Route::get('/impersonate/out', [ImpersonateController::class, 'out'])
        ->name('impersonate.out');

    Route::middleware('role:admin')->group(function () {
        Route::get('/impersonate/{user}', [ImpersonateController::class, 'in'])
            ->name('impersonate.in');

        Route::get('/users', [UsersController::class, 'index'])
            ->name('users.index');

        Route::get('/users/create', [UsersController::class, 'create'])
            ->name('users.create');

        Route::post('/users/store', [UsersController::class, 'store'])
            ->name('users.store');

        Route::get('/users/{user}/edit', [UsersController::class, 'edit'])
            ->name('users.edit');

        Route::put('/users/{user}', [UsersController::class, 'update'])
            ->name('users.update');

        Route::get('/users/{user}/services/edit', [UsersServicesController::class, 'edit'])
            ->name('users-services.edit');

        Route::put('/users/{user}/services', [UsersServicesController::class, 'update'])
            ->name('users-services.update');

        Route::get('/opening-hours/edit', [OpeningHoursController::class, 'edit'])
            ->name('opening-hours.edit');

        Route::put('/opening-hours/update', [OpeningHoursController::class, 'update'])
            ->name('opening-hours.update');
    });

});

require __DIR__.'/auth.php';
