<?php

// The namespace for this test class, which belongs to the "Feature" testing category.
namespace Tests\Feature;

// Import necessary classes and traits for the test.
use Illuminate\Foundation\Testing\RefreshDatabase; // Trait to refresh the database between tests.
use Tests\TestCase; // The base test class for Laravel testing.
use App\Models\User; // The User model, which we'll use to create and interact with user data.

class ViewUserTest extends TestCase
{
    // Use the RefreshDatabase trait to ensure the database is reset before each test, ensuring clean state.
    use RefreshDatabase;

    // Define the test method to verify that a user can be viewed.
    public function test_it_views_a_user()
    {
        // Create a new user instance using the User factory and store it in the database.
        // This simulates the pre-existing user who will be viewed in the test.
        $user = User::factory()->create();

        // Send a GET request to the '/users/{user}' route with the user's ID to view the user's profile.
        // The `get()` method simulates an HTTP GET request.
        $response = $this->get("/users/{$user->id}");

        // Assert that the HTTP status code of the response is 200 (OK), meaning the page loaded successfully.
        $response->assertStatus(200);

        // Assert that the response contains the user's name (this checks if the name is correctly displayed).
        // This works for an HTML response, where the user's name is expected to be displayed.
        $response->assertSee($user->name);

        // Assert that the response contains the user's email (checks if the email is displayed on the page).
        // This also works for an HTML response, ensuring the email is visible.
        $response->assertSee($user->email);
    }
}
