<?php

namespace App\Application\User\Repositories;

// Import the Eloquent User model from the infrastructure layer (database layer)
use App\Models\User;

/**
 * Interface UserRepository
 *
 * This interface defines a contract for a User Repository responsible for
 * interacting with the User model. It abstracts the persistence logic so
 * that different implementations (e.g., Eloquent, memory, file-based) can
 * be used interchangeably without changing the application logic.
 */
interface UserRepository
{
    /**
     * Find a user by their ID or fail.
     *
     * This method attempts to retrieve a user from the data source using the provided ID.
     * If the user is not found, an exception (usually ModelNotFoundException) should be thrown.
     * This is useful for fail-fast operations where a missing user is considered an error.
     *
     * @param int $id The unique identifier of the user.
     * @return User   The User model instance that was found.
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If no user is found.
     */
    public function findOrFail(int $id): User;

    /**
     * Persist a User model to the database.
     *
     * This method should handle both creating new records and updating existing ones,
     * depending on whether the given User instance already exists in the database.
     *
     * @param User $user The User model instance to be saved.
     * @return bool      Returns true if the save operation was successful, false otherwise.
     */
    public function save(User $user): bool;
}
