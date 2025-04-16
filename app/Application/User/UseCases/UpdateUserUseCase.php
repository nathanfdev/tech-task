<?php

namespace App\Application\User\UseCases;

use App\Domain\User\Repositories\UserRepositoryInterface;
use App\Domain\User\Entities\User as DomainUser;

class UpdateUserUseCase
{
    /**
     * @var UserRepositoryInterface $userRepository
     * The repository interface for interacting with the data layer.
     * This will be used to fetch and update user data from the storage.
     */
    protected $userRepository;

    /**
     * UpdateUserUseCase constructor.
     *
     * This constructor binds the repository dependency, allowing the use case
     * to perform actions on the user repository.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        // Inject the repository into the use case so it can be used to find and update users
        $this->userRepository = $userRepository;
    }

    /**
     * Update the user's details in the system.
     *
     * This method accepts user information, fetches the corresponding user entity from
     * the repository, updates its properties, and then persists the changes to the repository.
     *
     * @param int $id The ID of the user to be updated
     * @param string $name The new name for the user
     * @param string $email The new email for the user
     * @param string|null $password An optional new password for the user, or null if the password should remain unchanged
     * @return DomainUser The updated user entity
     */
    public function execute(int $id, string $name, string $email, ?string $password): DomainUser
    {
        // Retrieve the user from the repository using the provided ID
        $user = $this->userRepository->findById($id);

        // Update the user's name and email properties in the domain model
        $user->setName($name);   // Set the new name for the user
        $user->setEmail($email); // Set the new email for the user
        
        // If a new password is provided, update it in the domain model
        if ($password) {
            // Set the new password for the user, typically hashed before storage
            $user->setPassword($password);
        }

        // Persist the updated user back to the repository (the persistence layer)
        $updatedUser = $this->userRepository->update($user);

        // Return the updated user entity
        return $updatedUser;
    }
}
