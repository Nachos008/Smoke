@extends('layout.layout')
@section('content')   
<link rel="stylesheet" href="{{asset('styles/style2.css')}}">

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
       <div id="libraryContainer">
        <h1>Game Library</h1>
        <h2>Name:</h2>
        <article class="projectZ">
          <img class=novehryimg src="Boxshot_of_video_game_Project_zomboid.jpg" alt="Game 1">
          <div class="text-content1">
            <h2>Project Zomboid</h2>
        </div>
        </article>
        <article class="pubg">
          <img class=novehryimg src="44b6bfcd7956199bd50eb156219292e80b76a108d6ac4c6e.avif" alt="Game 2">
          <div class="text-content1">
            <h2>PlayerUnknown's Battlegrounds</h2>
        </div>
        </article>
        <article class="ron">
          <img class=novehryimg src="MV5BODU3NDFjZjktNzA0Ni00ZTFmLWIzN2ItNDZlOGYwOTAwMmQ3XkEyXkFqcGdeQXVyMTM2MTExNDIx._V1_FMjpg_UX1000_.jpg" alt="Game 3">
          <div class="text-content1">
            <h2>Ready Or Not</h2>
        </div>
        </article>
        <article class="lethalC">
          <img class=novehryimg src="capsule_616x353.jpg" alt="Game 4">
          <div class="text-content1">
            <h2>Lethal Company</h2>
        </div>
      </article>
        <article class="fc24">
          <img class=novehryimg src="download.jpeg" alt="Game 5">
          <div class="text-content1">
            <h2>FC 24</h2>
        </div>
        </article>
        <article class="Cult">
          <img class=novehryimg src="Cult_of_the_Lamb_Key_Art.png" alt="Game 6">
          <div class="text-content1">
            <h2>Cult of the Lamb</h2>
        </div>
        </article>
        <article class="Hell">
          <img class=novehryimg src="Hell_Let_Loose_cover_art.jpg" alt="Game 7">
          <div class="text-content1">
            <h2>Hell Let Loose</h2> 
        </div>
        </article>
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