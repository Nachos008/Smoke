@extends('layout.layout')
@section('content')  
<link rel="stylesheet" href="{{asset('styles/style3.css')}}">

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style3.css">
</head>
<body>
       <div class="otazka1">
        <div class="precootazka1">
            <p>
              Why Choose Game Review Websites?
            </p>
        </div>
        <p class="odpoved1">
          In the vast world of video games, the decision to purchase a new game is often a challenging task.
            <br>Promises from developers and marketing tricks can be misleading and don't always provide an accurate picture of what to expect from a particular game.
            <br>This is where game reviews come into play, offering you a reliable guide to the virtual gaming world.
        </p>
       </div>

       

       <button id="homeButton" onclick="scrollToTop()">Home</button>

      <script>
        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
      </script>

</body>
</html>
@endsection