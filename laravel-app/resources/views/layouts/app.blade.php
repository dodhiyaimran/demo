<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <nav>
        <a href="{{ route('users.index') }}">Users</a>
        <a href="{{ route('categories.index') }}">Categories</a>
        <a href="{{ route('projects.index') }}">Projects</a>
        <a href="{{ route('inquiries.index') }}">Inquiries</a>
    </nav>
    <div class="mt-4">
        @yield('content')
    </div>
</body>
</html>
