<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;  // Base controller class for all controllers
use Illuminate\Http\Request;          // Handle incoming HTTP requests
use App\Models\User;                  // Eloquent User model for database interaction
use App\Application\User\Services\UserService;  // Service class for user-related logic
use App\Application\User\UseCases\CreateUserUseCase;  // Use case for creating a user
use App\Application\User\UseCases\UpdateUserUseCase;  // Use case for updating a user
use App\Application\User\DTOs\CreateUserDTO;  // Data Transfer Object (DTO) for creating users

class UserController extends Controller
{
    // Declare the $userService property to hold the injected UserService instance
    protected $userService;

    /**
     * Inject the UserService dependency into the controller.
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        // Assign the injected UserService to the controller's property
        $this->userService = $userService;
    }

    /**
     * Display a list of users.
     *
     * This method retrieves all users from the database and passes them to the 'users.index' view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve all users from the database using Eloquent
        $users = User::all();

        // Return the 'index' view, passing the users data to the view
        return view('users.index', compact('users'));
    }

    /**
     * Show a single user's details.
     *
     * This method finds the user by ID and passes the user data to the 'users.show' view.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Retrieve the user by ID, or fail with a 404 if not found
        $user = User::findOrFail($id);

        // Return the 'show' view, passing the user data to the view
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing a user's details.
     *
     * This method retrieves the user by ID and passes the user data to the 'users.edit' view.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function showUpdateForm($id)
    {
        // Retrieve the user by ID, or fail with a 404 if not found
        $user = User::findOrFail($id);

        // Return the 'edit' view, passing the user data to the view
        return view('users.edit', compact('user'));
    }

    /**
     * Store a newly created user in the database.
     *
     * This method validates the incoming request, creates a new user via a UseCase,
     * and then redirects to the user index page with a success message.
     *
     * @param \Illuminate\Http\Request $request
     * @param CreateUserUseCase $createUserUseCase
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, CreateUserUseCase $createUserUseCase)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string',                      // Name is required and must be a string
            'email' => 'required|email|unique:users,email',    // Email must be unique in the users table
            'password' => 'required|string|min:6',             // Password must be at least 6 characters
        ]);

        // Create a DTO (Data Transfer Object) using the validated data
        $dto = new CreateUserDTO(
            name: $validated['name'],    // Pass name from the validated data
            email: $validated['email'],  // Pass email from the validated data
            password: $validated['password'] // Pass password from the validated data
        );

        // Execute the CreateUserUseCase with the DTO to create a new user
        $user = $createUserUseCase->execute($dto);

        // Redirect back to the users index page with a success message
        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    /**
     * Show the form for creating a new user.
     *
     * This method simply returns the 'create' view where the user can input their data.
     *
     * @return \Illuminate\View\View
     */
    public function showCreateForm()
    {
        // Return the 'create' view to show the user creation form
        return view('users.create');
    }

    /**
     * Update an existing user's details.
     *
     * This method validates the request, updates the user in the database,
     * and redirects to the user index page with a success message.
     *
     * @param \Illuminate\Http\Request $request
     * @param UpdateUserUseCase $updateUserUseCase
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, UpdateUserUseCase $updateUserUseCase, $id)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string',                // Name is required and must be a string
            'email' => 'required|email|unique:users,email,' . $id,  // Email must be unique, but allow for the current user's email
            'password' => 'nullable|string|min:6',      // Password is optional and must be at least 6 characters if provided
        ]);

        // Retrieve the user by ID, or fail with a 404 if not found
        $user = User::findOrFail($id);

        // Update the user's password if it's provided and not empty
        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);  // Hash the new password before saving
        }

        // Update the other fields of the user
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Save the updated user back to the database
        $user->save();

        // Redirect back to the users index page with a success message
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    /**
     * Delete a user from the database.
     *
     * This method deletes the user with the given ID and redirects to the user index page with a success message.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Retrieve the user by ID, or fail with a 404 if not found
        $user = User::findOrFail($id);

        // Delete the user from the database
        $user->delete();

        // Redirect back to the users index page with a success message
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
