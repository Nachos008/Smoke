@extends('layout.layout')
@section('content')   
<link rel="stylesheet" href="{{asset('styles/library.css')}}">

<div style="display:none;" id="debug">
    @foreach($games as $game)
        <div>Game: {{ $game->title }}, ID: {{ $game->game_id ?? $game->id }}</div>
    @endforeach
</div>

<div class="library">
    <div class="sidebar">
        <h2>My Games</h2>
        <ul>
            @forelse($games as $game)
                <li data-game-id="{{ $game->game_id ?? $game->id }}" class="game-item {{ isset($selectedGame) && ($selectedGame->game_id ?? $selectedGame->id) == ($game->game_id ?? $game->id) ? 'active' : '' }}">
                    {{ $game->title }}
                </li>
            @empty
                <li class="empty-library">No games in your library yet</li>
            @endforelse
        </ul>
    </div>
    <div class="content">
        <div id="game-details-container">
            @if(isset($selectedGame))
                <div class="game-details">
                    <h2>{{ $selectedGame->title }}</h2>
                    <div class="game-info">
                        <div class="game-image">
                            <img src="{{ $selectedGame->cover_image }}" alt="{{ $selectedGame->title }}">
                        </div>
                        <div class="game-metadata">
                            <p class="game-description">{{ $selectedGame->description }}</p>
                            <div class="game-specs">
                                <p><span>Publisher:</span> {{ $selectedGame->publisher }}</p>
                                <p><span>Developer:</span> {{ $selectedGame->developer }}</p>
                                <p><span>Release Date:</span> {{ $selectedGame->release_date }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="no-game-selected">
                    <p>Select a game from your library to view details</p>
                </div>
            @endif
        </div>
    </div>
</div>    

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const gameItems = document.querySelectorAll(".game-item");
        let previewDiv = null;

        if (gameItems.length === 0) {
            console.error("No elements with class 'game-item' found! Check your HTML.");
        }

        gameItems.forEach(item => {
            
            item.addEventListener("mouseenter", function (event) {
                const gameId = item.dataset.gameId;
                if (!gameId) return; 

                const rect = item.getBoundingClientRect();
                previewDiv.style.position = "absolute";
                previewDiv.style.top = `${rect.top + window.scrollY}px`;
                previewDiv.style.left = `${rect.right + 10}px`;
            });

            item.addEventListener("mouseleave", function () {
                if (previewDiv) {
                    previewDiv.remove();
                    previewDiv = null;
                }
            });

            item.addEventListener("click", function () {
                gameItems.forEach(el => el.classList.remove("active"));
                item.classList.add("active");
                const gameId = item.dataset.gameId;

                if (gameId) {
                    window.location.href = `/library?game=${gameId}`;
                } else {
                    console.error("Missing data-game-id attribute");
                }
            });
        });
    });
</script>

@endsection