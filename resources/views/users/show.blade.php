<!-- resources/views/users/show.blade.php -->

<!-- Standard HTML document setup -->
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Set character encoding for the document to UTF-8 -->
    <meta charset="UTF-8">

    <!-- Ensure the page is responsive on all devices by setting the viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title shown in the browser tab -->
    <title>User Details</title>

    <!-- Load Bootstrap 5 CSS from a CDN for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Bootstrap container with margin-top for spacing -->
<div class="container mt-5">
    
    <!-- Page heading -->
    <h1 class="mb-4">User Details</h1>

    <!-- Display user's name -->
    <div class="mb-3">
        <strong>Name:</strong> {{ $user->name }} <!-- Access user name using $user object -->
    </div>

    <!-- Display user's email -->
    <div class="mb-3">
        <strong>Email:</strong> {{ $user->email }} <!-- Access user email using $user object -->
    </div>

    <!-- Button to go back to the users list -->
    <a href="{{ route('users.index') }}" class="btn btn-primary">Back to Users List</a>
</div>

<!-- Bootstrap JS and Popper.js for dropdowns and other interactive features -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
