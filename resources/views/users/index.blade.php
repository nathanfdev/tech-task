<!-- resources/views/users/index.blade.php -->

<!-- Standard HTML document setup -->
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Set character encoding for the document -->
    <meta charset="UTF-8">

    <!-- Make sure the page is responsive on all screen sizes -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title shown in the browser tab -->
    <title>Manage Users</title>

    <!-- Load Bootstrap 5 CSS from CDN for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Bootstrap container with margin top for spacing -->
<div class="container mt-5">
    
    <!-- Page heading -->
    <h1 class="mb-4">Users</h1>

    <!-- Show success message if available in session (e.g., after create/update/delete actions) -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Button to navigate to the user creation form -->
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-4">Create New User</a>

    <!-- Display users in a table -->
    <table class="table">
        <thead>
            <tr>
                <!-- Table column headers -->
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <!-- Loop through each user passed to the view -->
            @foreach ($users as $user)
                <tr>
                    <!-- Display user's name and email -->
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>

                    <!-- Action buttons for view, edit, and delete -->
                    <td>
                        <!-- Link to view user details -->
                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-info">View</a>

                        <!-- Link to edit user -->
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>

                        <!-- Form to delete the user -->
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf <!-- CSRF token for security -->
                            @method('DELETE') <!-- Use HTTP DELETE method -->

                            <!-- Submit button to delete the user -->
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Bootstrap JS for interactive components -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
