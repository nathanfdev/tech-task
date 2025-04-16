<?php

// Define the namespace for this class, which is part of the App\Providers namespace.
namespace App\Providers;

// Import necessary classes.
use Illuminate\Support\ServiceProvider; // The base class for service providers in Laravel.
use App\Application\User\Repositories\UserRepositoryInterface; // The interface for the user repository, defining the contract.
use App\Infrastructure\Persistence\EloquentUserRepository; // The Eloquent implementation of the UserRepositoryInterface, which interacts with the database.

class UserRepositoryServiceProvider extends ServiceProvider
{
    // The register method is used to bind interfaces to implementations in the service container.
    public function register()
    {
        // Bind the UserRepositoryInterface to the EloquentUserRepository implementation in the Laravel service container.
        // This means that whenever UserRepositoryInterface is requested, an instance of EloquentUserRepository will be provided.
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
    }

    // The boot method is used to perform any necessary booting logic after all services have been registered.
    public function boot()
    {
        // The boot method is not required in this case, so it is left empty.
        // However, you can add logic here if you need to perform any additional tasks after the service container is booted.
    }
}
