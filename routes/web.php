<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    DashboardController,
    RoomTypeController,
    AmenityController,
    ExtraServiceController,
    RoomServiceController,
    MenuItemController,
    StaffController,
    RoleController,
    DepartmentController,
    SettingController,
    MenuCategoryController,
    RoomController,
};

// Public Home Page
Route::view('/', 'pages.home')->name('home');


/*
|--------------------------------------------------------------------------
| AUTH ROUTES (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (Hotel System)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'hierarchy:2'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard accessible by hotel admin + super admin + staff
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Profile for all logged-in users
        Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

        /*
        |--------------------------------------------------------------------------
        | HOTEL ADMIN + SUPER ADMIN (level 0 & 1)
        |--------------------------------------------------------------------------
        */
        Route::middleware('hierarchy:1')->group(function () {

            // SETUPS
            Route::resource('room-types', RoomTypeController::class);
            Route::resource('amenities', AmenityController::class);
            Route::resource('extra-services', ExtraServiceController::class);
            Route::resource('room-services', RoomServiceController::class);
            Route::put('/room-services/{room_service}/status', [RoomServiceController::class, 'updateStatus'])
                ->name('room-services.update-status');
            Route::resource('menu-items', MenuItemController::class);
            Route::put('/menu-items/{menuItem}/status', [MenuItemController::class, 'updateStatus'])
                ->name('menu-items.update-status');


            // MENU CATEGORIES (modal based)
            Route::post('menu-categories', [MenuCategoryController::class, 'store'])->name('menu-categories.store');
            Route::put('menu-categories/{category}', [MenuCategoryController::class, 'update'])->name('menu-categories.update');
            Route::delete('menu-categories/{category}', [MenuCategoryController::class, 'destroy'])->name('menu-categories.destroy');

            // ROOMS
            Route::get('/rooms', [RoomController::class, 'index'])
                ->name('rooms.index');

            Route::get('/rooms/create', [RoomController::class, 'create'])
                ->name('rooms.create');

            Route::post('/rooms', [RoomController::class, 'store'])
                ->name('rooms.store');

            Route::put('/rooms/{room}', [RoomController::class, 'update'])
                ->name('rooms.update');

            Route::delete('/rooms/{room}', [RoomController::class, 'destroy'])
                ->name('rooms.destroy');

            Route::put('/rooms/{room}/status', [RoomController::class, 'updateStatus'])
                ->name('rooms.update-status');

            // STAFF MANAGEMENT
            Route::resource('staff', StaffController::class);

        });

        /*
        |--------------------------------------------------------------------------
        | SUPER ADMIN ONLY (level 0)
        |--------------------------------------------------------------------------
        */
        Route::middleware('hierarchy:0')->group(function () {

            Route::resource('roles', RoleController::class)->except(['show']);
            Route::resource('departments', DepartmentController::class)->except(['show']);

            // Settings
            Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
            Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');
            Route::put('/settings/{setting}', [SettingController::class, 'update'])->name('settings.update');
        });
    });
