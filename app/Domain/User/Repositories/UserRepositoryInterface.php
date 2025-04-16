<?php

namespace App\Domain\User\Repositories;

use App\Domain\User\Entities\User as DomainUser;  // Import the DomainUser entity, which represents a user in the domain layer

/**
 * Interface UserRepositoryInterface
 *
 * This interface defines the contract for any repository that handles user data.
 * It is responsible for data persistence (e.g., saving, fetching users from a database).
 * The methods in this interface abstract away the underlying implementation details (e.g., Eloquent, raw SQL, etc.).
 *
 * @package App\Domain\User\Repositories
 */
interface UserRepositoryInterface
{
    /**
     * Save a user.
     *
     * This method is used to persist a user in the data store (e.g., database).
     * It will either create a new user or update an existing user.
     *
     * @param DomainUser $user  The user entity to be saved
     * @return DomainUser  The saved user entity, typically with an ID (in the case of a new user)
     */
    public function save(DomainUser $user): DomainUser;

    /**
     * Get all users.
     *
     * This method retrieves all users from the data store.
     * It returns an array of DomainUser entities representing all users.
     *
     * @return DomainUser[]  An array of DomainUser objects
     */
    public function getAll(): array;

    /**
     * Find a user by ID.
     *
     * This method is used to find and retrieve a user by their unique identifier (ID).
     * If a user with the given ID does not exist, it could throw an exception or return a null value.
     *
     * @param int $id  The unique identifier of the user
     * @return DomainUser  The user entity corresponding to the given ID
     */
    public function findById(int $id): DomainUser;
}
