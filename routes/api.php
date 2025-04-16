<?php

// Importing the necessary classes for route handling
use Illuminate\Support\Facades\Route; // For defining routes
use App\Http\Controllers\Api\UserController; // Importing the UserController for handling API requests related to users

// Defining a route for debugging, to check if the API routes are working
Route::get('/debug', function () {
    // Returning a JSON response indicating that the API routes are functional
    return response()->json(['message' => 'API routes are working']);
});

// Defining a POST route to create a new user
// This route listens for POST requests at /users and delegates the handling to the store method in the UserController
Route::post('/users', [UserController::class, 'store']); // The UserController's store method will handle the logic for creating a user
