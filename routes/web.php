<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Champion\MilkBagController;
use App\Http\Controllers\Champion\MyProvidersController;
use App\Http\Controllers\Chat\MessageController;
use App\Http\Controllers\Chat\ThreadController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MilkRequestDetailController;
use App\Http\Controllers\MilkRequestReceiptController;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\Verify;
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

Route::view('/', 'welcome')->name('home');

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)
        ->name('login');

    Route::get('register', Register::class)
        ->name('register');
});

Route::get('password/reset', Email::class)
    ->name('password.request');

Route::get('password/reset/{token}', Reset::class)
    ->name('password.reset');

Route::middleware('auth')->group(function () {
    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    Route::get('password/confirm', Confirm::class)
        ->name('password.confirm');
});

Route::middleware('auth')->group(function () {
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', LogoutController::class)
        ->name('logout');
});

Route::view('/complete-registration', 'private.complete-registration')
    ->middleware(['auth', 'partial'])
    ->name('complete-registration');

Route::middleware(['auth', 'verified', 'type:admin'])
    ->name('admin.')
    ->group(function () {
        Route::get('/admin/dashboard', DashboardController::class)
            ->name('dashboard');

        Route::view('/admin/profile', 'admin.profile')
            ->name('profile');

        Route::resource('users', UserController::class)->only('index', 'show', 'update');

        Route::get('/admins', [AdminController::class, 'index'])->name('admin.index');
        Route::post('/admins', [AdminController::class, 'store'])->name('admin.store');
        Route::get('/admins/{user}/show', [AdminController::class, 'show'])->name('admin.show');
        Route::patch('/admin/{user}', [AdminController::class, 'update'])->name('admin.update');
    });

Route::middleware(['auth', 'verified', 'registered'])->group(function () {
    Route::get('/dashboard', DashboardController::class)
        ->name('dashboard');

    Route::view('/profile', 'private.profile')
        ->name('profile');

    Route::get('/t', [ThreadController::class, 'index'])->name('threads.index');
    Route::put('/t/{user}', [ThreadController::class, 'create'])->name('threads.create');

    Route::get('/t/{thread}', [MessageController::class, 'show'])->name('threads.messages');

    Route::post('/t/{thread}/send-message', [MessageController::class, 'send'])->name('threads.message.send');

    Route::middleware('type:requester')
        ->name('requester.')
        ->group(function () {
            Route::get('/my-request/{milkRequest:ref_number}', MilkRequestDetailController::class)
                ->name('milk-request-detail');
        });

    Route::middleware('type:champion')
        ->name('champion.')
        ->group(function () {
            Route::get('/my-providers', MyProvidersController::class)
                ->name('my-providers');

            Route::get('/milk-bag', [MilkBagController::class, 'index'])
                ->name('milk-bag.index');

            Route::get('/milk-bag/{championProvider}/detail', [MilkBagController::class, 'show'])
                ->name('milk-bag.show');

            Route::get('/milk-request/{milkRequest:ref_number}', MilkRequestDetailController::class)
                ->name('milk-request-detail');

            Route::get('/download/milk-request/{milkRequest}', MilkRequestReceiptController::class)
                ->name('milk-request.download');

            Route::view('/reports/milk-requests', 'champion.reports.milk-request')
                ->name('reports.milk-requests');

//            Route::view('/reports/milk-bag-transactions', 'champion.reports')
//                ->name('reports.milk-bag-transactions');
        });
});
