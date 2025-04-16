<?php

namespace App\Application\User\Services;

// Import the user repository interface which abstracts data access logic
use App\Domain\User\Repositories\UserRepositoryInterface;

// Import the domain user entity
use App\Domain\User\Entities\User as DomainUser;

class UserService
{
    // Declare the protected property to hold the user repository instance
    protected $userRepository;

    /**
     * Constructor dependency injection of the UserRepositoryInterface.
     * This keeps the service decoupled from the specific persistence implementation
     * and adheres to the Dependency Inversion Principle.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Create and persist a new user.
     *
     * This method handles creating a domain user instance and saving it
     * via the repository. It ensures that passwords are hashed before storage.
     *
     * @param string $name     The name of the user
     * @param string $email    The email of the user
     * @param string $password The raw password, which will be hashed
     * @return DomainUser      The newly created user entity with an assigned ID
     */
    public function createUser(string $name, string $email, string $password): DomainUser
    {
        // Instantiate a new DomainUser with a null ID (to be assigned by the database)
        // and a hashed password for security
        $createdUser = $this->userRepository->save(new DomainUser(
            null,               // ID is null for new records
            $name,              // User's name
            $email,             // User's email
            bcrypt($password)   // Hash the password before persisting
        ));

        // Return the created user entity (now with ID from the DB)
        return $createdUser;
    }

    /**
     * Retrieve all users.
     *
     * This method fetches all users from the repository and returns them
     * as an array of domain user entities.
     *
     * @return DomainUser[] An array of domain users
     */
    public function getAllUsers(): array
    {
        // Delegate fetching to the repository
        return $this->userRepository->getAll();
    }
}
