<!-- resources/views/users/create.blade.php -->

<!-- Standard HTML document setup -->
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Set the character encoding to UTF-8 to ensure proper handling of text characters -->
    <meta charset="UTF-8">

    <!-- Make the page responsive on all devices by setting the viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title displayed in the browser tab -->
    <title>Create User</title>

    <!-- Bootstrap 5 CSS is included from a CDN to style the page -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Bootstrap container with margin-top for spacing -->
<div class="container mt-5">

    <!-- Page heading for creating a new user -->
    <h1 class="mb-4">Create a New User</h1>

    <!-- Success message display, shown only if there is a session success message -->
    @if (session('success'))
        <div class="alert alert-success">
            <!-- Display the success message stored in the session -->
            {{ session('success') }}
        </div>
    @endif

    <!-- Form to create a new user -->
    <form action="{{ url('/create-user') }}" method="POST">
        <!-- CSRF token for security, protects against cross-site request forgery attacks -->
        @csrf

        <!-- Input field for the user's name -->
        <div class="mb-3">
            <!-- Label and input field for the user's name -->
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
            <!-- Display validation error for the name if there is one -->
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Input field for the user's email -->
        <div class="mb-3">
            <!-- Label and input field for the user's email -->
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
            <!-- Display validation error for the email if there is one -->
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Input field for the user's password -->
        <div class="mb-3">
            <!-- Label and input field for the user's password -->
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" required>
            <!-- Display validation error for the password if there is one -->
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit button to create the new user -->
        <button type="submit" class="btn btn-primary">Create User</button>
    </form>

    <!-- Link to go back to the list of users -->
    <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Back to Users List</a>
</div>

<!-- Bootstrap JS and Popper.js for enabling interactive elements like dropdowns, tooltips, etc. -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
