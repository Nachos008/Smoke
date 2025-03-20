<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('styles/register.css')}}">
    <title>Document</title>
</head>
<body>
    <div class="formDiv">
        <form method="POST" action="/register"> 
            @csrf
            <input type="text" name="name" placeholder="Username" required class="field">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="password_confirm" placeholder="Confirm Password" required>
            <button type="submit">Register</button>
            <div class="textDiv">
                <p>Already registered?</p>
                <a href="{{route ('login')}}">Login</a>
            </div>
        </form>
    </div>
</body>
</html>