<?php

// The namespace for this test class, which belongs to the "Feature" testing category.
namespace Tests\Feature;

// Import necessary classes and traits for the test.
use Illuminate\Foundation\Testing\RefreshDatabase; // Trait to refresh the database between tests.
use Tests\TestCase; // The base test class for Laravel testing.
use App\Models\User; // The User model, which we'll use to create and interact with user data.

class UpdateUserTest extends TestCase
{
    // Use the RefreshDatabase trait to ensure the database is reset before each test, ensuring clean state.
    use RefreshDatabase;

    // Define the test method to verify that a user can be updated.
    public function test_it_updates_a_user()
    {
        // Create a new user instance using the User factory and store it in the database.
        // This simulates the pre-existing user who will be updated in the test.
        $user = User::factory()->create();

        // Send a PUT request to the '/users/{user}' route with the user's ID and updated data.
        // The `put()` method simulates a PUT request to update an existing user's data.
        $response = $this->put("/users/{$user->id}", [
            'name' => 'Updated Name',         // New name for the user.
            'email' => 'updated@example.com', // New email for the user.
            'password' => 'newpassword123',   // New password for the user (though password may be hashed in real scenarios).
        ]);

        // Assert that the response redirects to the 'users.index' route after a successful update.
        // This indicates that after updating, the application should show the list of users.
        $response->assertRedirect(route('users.index'));

        // Assert that the database contains the updated user data.
        // This confirms that the changes (name and email) were persisted in the database.
        $this->assertDatabaseHas('users', [
            'id' => $user->id,                        // Ensure the user ID remains the same.
            'name' => 'Updated Name',                  // Assert that the 'name' field was updated.
            'email' => 'updated@example.com',         // Assert that the 'email' field was updated.
        ]);
    }
}
