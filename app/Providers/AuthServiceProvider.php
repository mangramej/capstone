<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Requester\MilkRequest;
use App\Policies\MilkRequestPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        MilkRequest::class => MilkRequestPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
