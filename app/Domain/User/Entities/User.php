<?php 

namespace App\Domain\User\Entities;

/**
 * Class User
 *
 * This class represents a user entity in the **domain layer** of the application.
 * It encapsulates the attributes of a user, including their name, email, password, and optionally their ID.
 * The entity is used within the domain logic of the application and is typically passed between use cases, services, and repositories.
 *
 * The attributes of this entity are directly related to the core business logic of the application.
 * For example, a user can be created, updated, or deleted using this entity.
 *
 * @package App\Domain\User\Entities
 */
class User
{
    /**
     * User constructor.
     *
     * This constructor initializes a new instance of the User entity.
     * The `id` is optional (nullable) as it is not required when creating a new user, but is populated after the user is saved.
     * The `name`, `email`, and `password` fields are required to create a new user.
     *
     * @param int|null $id        The unique identifier of the user, optional and null when creating a new user.
     * @param string $name        The name of the user.
     * @param string $email       The email address of the user.
     * @param string $password    The password of the user, typically hashed before storage.
     */
    public function __construct(
        public ?int $id = null,    // The ID is nullable, so it's optional when creating a new user
        public string $name,       // The user's name, a required field for user creation
        public string $email,      // The user's email, a required field for user creation
        public string $password    // The user's password, required and typically stored in a hashed format
    ) {}
}
