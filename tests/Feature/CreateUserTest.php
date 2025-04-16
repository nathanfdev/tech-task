<?php

// The namespace for this test class, which belongs to the "Feature" testing category.
namespace Tests\Feature;

// The necessary trait for resetting the database between tests to ensure a clean state.
use Illuminate\Foundation\Testing\RefreshDatabase;

// Base test class to extend which provides testing functionality.
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    // Use the RefreshDatabase trait to reset the database state after each test
    // to ensure tests do not interfere with each other by leaving behind stale data.
    use RefreshDatabase;

    // Define a test method to verify that a user can be created via the form.
    public function test_it_creates_a_user()
    {
        // Sending a POST request to the '/create-user' route with the necessary data to create a user.
        // The `post()` method simulates a POST request to the specified URL with the given data.
        $response = $this->post('/create-user', [
            'name' => 'Jane Doe',            // The name of the user to be created.
            'email' => 'jane@example.com',   // The email address of the user.
            'password' => 'password123',     // The password of the user (note: this should be hashed in a real scenario).
        ]);

        // Asserting that after the form submission, the user is redirected to the users index page.
        // This confirms that the user creation was successful and that the redirect occurs.
        $response->assertRedirect(route('users.index'));

        // Asserting that the user data was correctly stored in the database.
        // This checks that a user with the email 'jane@example.com' exists in the 'users' table.
        $this->assertDatabaseHas('users', ['email' => 'jane@example.com']);
    }
}
