@extends('layout.layout')
@section('content')
<div id="libraryContainer">
    @if(isset($search) && $search)
        <h1>Search Results for "{{ $search }}"</h1>
    @endif

    @if(count($games) > 0)
        @foreach($games as $game)
        <article class="game-preview" data-id="{{ $game->id ?? $game->game_id }}">
            <img src="{{ $game->cover_image }}" alt="{{ $game->title }}" class="novehryimg">
            <div class="text-content1">
                <h2>{{ $game->title }}</h2>
                <p>{{ $game->description }}</p>
                <p>Price: ${{ $game->price }}</p>
                
                <!-- Check if game ID exists and pass it correctly -->
                <form action="{{ route('buy.game', ['id' => $game->id ?? $game->game_id]) }}" method="POST" style="display: inline;">
                    @csrf
                    @php
                        $isOwned = DB::table('user_games')->where('user_id', auth()->id())->where('game_id', $game->game_id ?? $game->id)->exists();
                    @endphp

                    @if (!$isOwned)
                        <button type="submit" class="buy-button">Purchase</button>
                    @else
                        <p><button type="submit" class="buy-button1" disabled>Owned</button></p>
                    @endif
                </form>
            </div>
        </article>
        @endforeach
    @else
        <div class="no-results">
            @if(isset($search) && $search)
                <p>No games found matching "{{ $search }}". Try a different search term.</p>
            @else
                <p>No games available at the moment.</p>
            @endif
        </div>
    @endif
</div>

<link rel="stylesheet" href="{{asset('styles/store.css')}}">

<button id="homeButton" onclick="scrollToTop()">Home</button>

<script>
    function scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
    document.addEventListener("DOMContentLoaded", function () {
    const games = document.querySelectorAll(".game-preview");

    games.forEach(game => {
        game.addEventListener("click", function (e) {
            // Avoid interfering with button clicks inside the game card
            if (e.target.tagName.toLowerCase() === 'button' || 
                e.target.closest('button') || 
                e.target.tagName.toLowerCase() === 'form') {
                return;
            }

            const gameId = this.dataset.id;
            if (gameId) {
                window.location.href = "{{ url('store/game') }}/" + gameId;
            }
        });
    });
});
    
</script>
@endsection