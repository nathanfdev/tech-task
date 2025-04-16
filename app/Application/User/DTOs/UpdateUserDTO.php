<?php

namespace App\Application\User\DTOs;

/**
 * Class UpdateUserDTO
 *
 * A Data Transfer Object (DTO) for encapsulating the data required
 * to update a user. DTOs are simple containers that carry data between
 * layers (e.g., from a controller to a use case), promoting separation of concerns.
 */
class UpdateUserDTO
{
    /**
     * Constructor to initialize the properties of the DTO.
     *
     * @param string $name     The updated name of the user.
     * @param string $email    The updated email of the user.
     * @param string $password The updated password of the user.
     *
     * Note: It's the responsibility of the calling code to hash the password if needed.
     */
    public function __construct(
        public string $name,      // User's new name
        public string $email,     // User's new email address
        public string $password   // User's new password
    ) {}
}
