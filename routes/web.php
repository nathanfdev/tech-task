<?php

// Importing the UserController from the Users namespace, so we can use it for handling routes related to user actions.
use App\Http\Controllers\Users\UserController;

// Routes for managing users

// This route handles the main home page of the application, which displays a list of users or some other welcome content.
// The `index` method of `UserController` will be responsible for handling this route.
Route::get('/', [UserController::class, 'index'])->name('home'); 

// This route displays a list of all users.
// The `index` method in `UserController` will handle the logic for fetching and displaying the list of users.
Route::get('/users', [UserController::class, 'index'])->name('users.index');

// This route is responsible for showing the form to create a new user.
// It points to the `showCreateForm` method of `UserController`, which will render a view for user creation.
Route::get('/create-user', [UserController::class, 'showCreateForm'])->name('users.create');

// This route handles the submission of the form to create a new user.
// It is a POST request because we're sending data (user information) to the server to store it in the database.
// The `store` method in `UserController` will handle the request and save the user.
Route::post('/create-user', [UserController::class, 'store']);

// This route displays the details of a specific user.
// The `show` method of `UserController` is used to retrieve and display the details of a user identified by their unique ID.
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

// This route shows the form for editing a specific user's information.
// The `showUpdateForm` method in `UserController` will render the form with the user's existing data for updating.
Route::get('/users/{user}/edit', [UserController::class, 'showUpdateForm'])->name('users.edit');

// This route handles the submission of the form for updating a specific user.
// It uses the `PUT` HTTP method because we are updating the existing user resource with new data.
// The `update` method in `UserController` will process the request to update the user in the database.
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

// This route handles the deletion of a specific user.
// The `destroy` method in `UserController` will delete the user identified by their unique ID from the database.
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
