<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('styles/login.css')}}">
    <title>Document</title>
</head>
<body>
    <div class="formDiv">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Password">
            <button type="submit">Login</button>
            <div class="textDiv">
                <p>Dont have an account?</p>
                <a href="{{route ('register')}}">Register</a>
            </div>
        </form>
    </div>
</body>
</html>
