<?php

// The namespace for this test class, which belongs to the "Feature" testing category.
namespace Tests\Feature;

// The necessary trait for resetting the database between tests to ensure a clean state.
use Illuminate\Foundation\Testing\RefreshDatabase;

// Base test class to extend which provides testing functionality.
use Tests\TestCase;

// Import the User model to create a user instance for testing.
use App\Models\User;

class DeleteUserTest extends TestCase
{
    // Use the RefreshDatabase trait to reset the database state after each test
    // to ensure tests do not interfere with each other by leaving behind stale data.
    use RefreshDatabase;

    // Define a test method to verify that a user can be deleted.
    public function test_it_deletes_a_user()
    {
        // Create a user instance using the User factory and persist it in the database.
        // This simulates creating a user that will be deleted in the test.
        $user = User::factory()->create();

        // Sending a DELETE request to the '/users/{user}' route with the user's ID.
        // The `delete()` method simulates a DELETE request to the specified URL.
        $response = $this->delete("/users/{$user->id}");

        // Asserting that after the delete request, the user is redirected to the users index page.
        // This confirms that the deletion action was successful and that the redirect occurred.
        $response->assertRedirect(route('users.index'));

        // Asserting that the user has been successfully removed from the database.
        // This checks that the 'users' table no longer contains the record with the deleted user's ID.
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
