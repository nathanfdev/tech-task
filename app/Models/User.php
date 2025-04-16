<?php

namespace App\Models;

// Import necessary classes from Laravel
use Illuminate\Database\Eloquent\Factories\HasFactory; // Provides factory support for the model
use Illuminate\Foundation\Auth\User as Authenticatable; // Base class for authenticatable users (includes authentication functionality)
use Illuminate\Notifications\Notifiable; // Provides support for notifications

// The User model represents a user in the application, extending the default Authenticatable class for authentication.
class User extends Authenticatable
{
    // Use HasFactory and Notifiable traits to add factory and notification capabilities to the model.
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * This array defines the fields that can be mass-assigned using methods like create() and update().
     * Mass assignment protects the model from being assigned attributes that should not be modified by the user.
     * The fields here are 'name', 'email', and 'password' in this case.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',    // Name of the user
        'email',   // Email address of the user
        'password', // Password for the user's account
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * These are the attributes that will not be included when the model is converted to an array or JSON.
     * For example, we typically hide the user's password and remember token from being exposed via API or to the front-end.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',      // The user's password should not be exposed when the model is serialized.
        'remember_token', // The remember token should also be hidden when serializing the model.
    ];

    /**
     * Get the attributes that should be cast.
     *
     * This method allows you to specify how certain attributes should be cast when accessing or manipulating them.
     * For example, the 'email_verified_at' attribute should be cast to a datetime instance, and the 'password' attribute
     * should be automatically hashed before being stored in the database.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', // The 'email_verified_at' column should be cast to a DateTime object.
            'password' => 'hashed', // The 'password' attribute should be cast to a hashed format (automatically handled by Eloquent).
        ];
    }
}
