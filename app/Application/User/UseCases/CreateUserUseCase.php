<?php

namespace App\Application\User\UseCases;

// Import the CreateUserDTO, which carries the user creation data
use App\Application\User\DTOs\CreateUserDTO;

// Import the interface for interacting with the user repository
use App\Domain\User\Repositories\UserRepositoryInterface;

// Import the domain user entity
use App\Domain\User\Entities\User;

class CreateUserUseCase
{
    /**
     * Constructor injects the UserRepositoryInterface.
     * This allows the use case to remain decoupled from any specific implementation,
     * following the Dependency Inversion Principle (DIP).
     *
     * @param UserRepositoryInterface $userRepo The repository interface for saving user data
     */
    public function __construct(private UserRepositoryInterface $userRepo) {}

    /**
     * Execute the user creation logic.
     *
     * This method takes a data transfer object (DTO) with user creation data,
     * constructs a Domain User entity, hashes the password, and saves the user
     * through the repository.
     *
     * @param CreateUserDTO $dto The data transfer object containing validated user input
     * @return User The newly created Domain User
     */
    public function execute(CreateUserDTO $dto): User
    {
        // Create a new Domain User entity with data from the DTO
        // The ID is set to null because it will be auto-generated when saved
        // The password is hashed before being passed to the repository
        $user = new User(
            id: null, 
            name: $dto->name,
            email: $dto->email,
            password: bcrypt($dto->password) // Secure the password before saving
        );

        // Save the user using the repository, which handles persistence
        // The repository will return the saved user entity with an assigned ID
        return $this->userRepo->save($user);
    }
}
