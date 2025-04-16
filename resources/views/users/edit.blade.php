<!-- resources/views/users/edit.blade.php -->

<!-- Standard HTML document setup -->
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Set character encoding for the document to UTF-8 -->
    <meta charset="UTF-8">

    <!-- Make the page responsive on all devices by setting the viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title displayed in the browser tab -->
    <title>Edit User</title>

    <!-- Bootstrap 5 CSS is included from a CDN for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Bootstrap container with margin-top for spacing -->
<div class="container mt-5">

    <!-- Page heading -->
    <h1 class="mb-4">Edit User</h1>

    <!-- Form to edit the user's details -->
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        <!-- CSRF token to protect against cross-site request forgery attacks -->
        @csrf

        <!-- HTTP method spoofing, as HTML forms only support GET and POST, 
             but we need to perform a PUT request to update the user -->
        @method('PUT')

        <!-- Input field for the user's name -->
        <div class="mb-3">
            <!-- Label and input field for the user's name -->
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>

        <!-- Input field for the user's email -->
        <div class="mb-3">
            <!-- Label and input field for the user's email -->
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>

        <!-- Input field for the user's password -->
        <div class="mb-3">
            <!-- Label and input field for the user's password -->
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control">
            <!-- Password field is optional, it will be updated only if provided -->
        </div>

        <!-- Submit button to update the user -->
        <button type="submit" class="btn btn-primary">Update User</button>
    </form>

    <!-- Button to go back to the users list page -->
    <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Back to Users List</a>
</div>

<!-- Bootstrap JS and Popper.js scripts to enable interactive elements like tooltips, modals, etc. -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
