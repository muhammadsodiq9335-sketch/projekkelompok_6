<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <p>This is a simple login page. Use the role-specific login pages if needed.</p>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="password" required>
        </div>
        <div>
            <label>Role</label>
            <select name="role">
                <option value="petugas">Petugas</option>
                <option value="perawat">Perawat</option>
                <option value="dokter">Dokter</option>
            </select>
        </div>
        <button type="submit">Login</button>
    </form>

    @if($errors->any())
        <div style="color:red">
            <ul>
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>
</html>
