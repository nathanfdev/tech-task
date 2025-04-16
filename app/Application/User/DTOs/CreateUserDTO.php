<?php

namespace App\Application\User\DTOs;

/**
 * Class CreateUserDTO
 *
 * A Data Transfer Object (DTO) that encapsulates the data
 * needed to create a new user in the system. It is used to transfer
 * user creation data across application layers (e.g., from the controller
 * to a use case or service), helping maintain a clean and organized codebase.
 */
class CreateUserDTO
{
    /**
     * Constructor to initialize the CreateUserDTO.
     *
     * @param string $name      The name of the user to be created.
     * @param string $email     The email address of the new user.
     * @param string $password  The plain-text password of the new user.
     *
     * Note: Password hashing should be handled by the service or use case layer,
     * not in the DTO itself, to keep it purely a data container.
     */
    public function __construct(
        public string $name,      // User's name
        public string $email,     // User's email
        public string $password   // User's password (plain text)
    ) {}
}
