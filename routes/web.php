<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RequesterVerificationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Champion\DonationCenterController;
use App\Http\Controllers\Champion\DonorApplicationController;
use App\Http\Controllers\Champion\DownloadRequesterMedicalRecordController;
use App\Http\Controllers\Champion\MilkBagController;
use App\Http\Controllers\Champion\ShowMilkRequestController;
use App\Http\Controllers\Champion\ShowProviderProfileController;
use App\Http\Controllers\Champion\ShowRequesterRequestHistoryController;
use App\Http\Controllers\Chat\MessageController;
use App\Http\Controllers\Chat\ThreadController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MilkRequestDetailController;
use App\Http\Controllers\MilkRequestReceiptController;
use App\Http\Controllers\Provider\DonateMilkController;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\Verify;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::view('/', 'welcome')->name('home');

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

// ADMIN ROUTES
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

        Route::name('requester-verification.')
            ->prefix('/admin/requester-verification')
            ->group(function () {
                Route::get('/', [RequesterVerificationController::class, 'index'])
                    ->name('index');

                Route::get('/{requesterVerification}', [RequesterVerificationController::class, 'show'])
                    ->name('show');

                Route::post('/{requesterVerification}/update-status', [RequesterVerificationController::class, 'update'])
                    ->name('update-status');

                Route::post('/{requesterVerification}/download', [RequesterVerificationController::class, 'download'])
                    ->name('download');
            });
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

    Route::middleware('type:provider')
        ->name('provider.')
        ->group(function () {
            Route::get('donate-milk', [DonateMilkController::class, 'index'])->name('donate-milk');
            Route::post('donate-milk', [DonateMilkController::class, 'store'])->name('donate-milk.store');
        });

    Route::middleware('type:requester')
        ->name('requester.')
        ->group(function () {
            Route::get('/my-request/{milkRequest:ref_number}', MilkRequestDetailController::class)
                ->name('milk-request-detail');

            Route::view('/get-verified', 'requester.get-verified')
                ->name('get-verified');

            Route::get('/download/{milkRequest}', MilkRequestReceiptController::class)
                ->name('milk-request.download');
        });

    // CHAMPION ROUTES
    Route::middleware('type:champion')
        ->name('champion.')
        ->group(function () {
            Route::get('/milk-bag', [MilkBagController::class, 'index'])
                ->name('milk-bag.index');

            Route::get('/milk-bag/{championProvider}/detail', [MilkBagController::class, 'show'])
                ->name('milk-bag.show');

            Route::get('/milk-request/{milkRequest:ref_number}', MilkRequestDetailController::class)
                ->name('milk-request-detail');

            Route::get('/download/milk-request/{milkRequest}', MilkRequestReceiptController::class)
                ->name('milk-request.download');

            Route::get('/requester-history/{user}', ShowRequesterRequestHistoryController::class)
                ->name('show-requester-request-history');

            Route::view('/reports/milk-requests', 'champion.reports.milk-request')
                ->name('reports.milk-requests');

            Route::view('/reports/milk-bag-transactions', 'champion.reports.milk-bag-transactions')
                ->name('reports.milk-bag-transactions');

            Route::get('/milk-requests/pending', [ShowMilkRequestController::class, 'pending'])
                ->name('show-milk-requests.pending');

            Route::post('/milk-requests/{requesterVerification}/download/attachment', DownloadRequesterMedicalRecordController::class)
                ->name('download-requester-medical-record');

            Route::get('/milk-requests/recent', [ShowMilkRequestController::class, 'recent'])
                ->name('show-milk-requests.recent');

            Route::resource('location', DonationCenterController::class);

            Route::name('my-providers.')->group(function () {
                Route::get('/provider/{user}/profile', ShowProviderProfileController::class)
                    ->name('show-provider-profile');

                Route::view('/approved-donor', 'champion.approved-donor')
                    ->name('approved-donor');

                Route::get('/donor-application', [DonorApplicationController::class, 'index'])
                    ->name('donor-application.index');

                Route::post('/donor-application/{providerApplication}', [DonorApplicationController::class, 'approve'])
                    ->name('donor-application.approve');

                Route::delete('/donor-application/{providerApplication}', [DonorApplicationController::class, 'decline'])
                    ->name('donor-application.decline');
            });
        });
});
