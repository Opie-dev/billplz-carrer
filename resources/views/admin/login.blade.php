<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{ asset('css/admin-login.css') }}">
    </head>
<body>
    <div class="card">
        <h1>Admin Login</h1>
        @if ($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf
            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required>
            <label for="password">Password</label>
            <input id="password" name="password" type="password" required>
            <button class="btn" type="submit">Login</button>
        </form>
    </div>
</body>
</html>


