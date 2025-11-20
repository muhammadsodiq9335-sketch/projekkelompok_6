<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login Perawat</title>
</head>
<body>
    <h1>Login Perawat</h1>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="hidden" name="role" value="perawat">
        <div>
            <label>Email</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
    @if($errors->any())
        <div style="color:red">
            {{ $errors->first() }}
        </div>
    @endif
</body>
</html>
