<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Owner\SalonController;
use App\Http\Controllers\Customer\SalonBrowseController;
use App\Http\Controllers\Customer\BookingController as CustomerBookingController;
use App\Http\Controllers\Owner\BookingController as OwnerBookingController;
use App\Http\Controllers\Owner\DashboardController as OwnerDashboardController;
use App\Http\Controllers\Customer\ReviewController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\StorageLinkController;
use App\Http\Controllers\Customer\PaymentController;
use App\Http\Controllers\MidtransWebhookController;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/account', [AccountController::class, 'index'])
    ->name('account.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('categories', CategoryController::class);

        Route::get('/users', [UserController::class, 'index'])
            ->name('users.index');

        Route::patch('/users/{user}/role', [UserController::class, 'updateRole'])
            ->name('users.update-role');

        Route::delete('/users/{user}', [UserController::class, 'destroy'])
            ->name('users.destroy');
    });

Route::middleware(['auth', 'role:owner'])
    ->prefix('owner')
    ->name('owner.')
    ->group(function () {
        Route::get('/dashboard', [OwnerDashboardController::class, 'index'])
    ->name('dashboard');

        Route::get('/salons/{salon}/services', [SalonController::class, 'services'])
            ->name('salons.services');

        Route::get('/salons/{salon}/gallery', [SalonController::class, 'gallery'])
            ->name('salons.gallery');

        Route::get('/salons/{salon}/staff', [SalonController::class, 'staff'])
            ->name('salons.staff');

        Route::resource('salons', SalonController::class);

        Route::get('/bookings', [OwnerBookingController::class, 'index'])
            ->name('bookings.index');

        Route::patch('/bookings/{booking}/complete', [OwnerBookingController::class, 'complete'])
            ->name('bookings.complete');

        Route::patch('/bookings/{booking}/cancel', [OwnerBookingController::class, 'cancel'])
            ->name('bookings.cancel');
    });

Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/customer/dashboard', function () {
        return view('customer.dashboard');
    })->name('customer.dashboard');

    Route::get('/salons/{salon}/booking', [SalonBrowseController::class, 'booking'])
        ->name('customer.salons.booking');

    Route::get('/my-bookings', [CustomerBookingController::class, 'index'])
        ->name('customer.bookings.index');

    Route::post('/bookings/{booking}/reviews', [ReviewController::class, 'store'])
        ->name('customer.reviews.store');

    Route::get('/bookings/{booking}/pay', [PaymentController::class, 'pay'])
    ->name('customer.bookings.pay');
    
});

Route::get('/salons', [SalonBrowseController::class, 'index'])
    ->name('customer.salons.index');

Route::get('/salons/{salon}', [SalonBrowseController::class, 'show'])
    ->name('customer.salons.show');

    Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/storage-link', \App\Http\Controllers\Admin\StorageLinkController::class)
    ->name('storage.link');

Route::get('/clear-cache', \App\Http\Controllers\Admin\ClearCacheController::class)
    ->name('clear.cache');

Route::post('/midtrans/webhook', MidtransWebhookController::class)
    ->name('midtrans.webhook');

require __DIR__.'/auth.php';