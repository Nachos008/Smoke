@extends('layout.layout')
@section('content')   
<link rel="stylesheet" href="{{asset('styles/library.css')}}">

<div class="library">
    <div class="sidebar">
        <h2>My Games</h2>
        <ul>
            @forelse($games as $game)
                <li>{{ $game->title }}</li>
            @empty
                <li>No games in your library yet</li>
            @endforelse
        </ul>
    </div>
    <div class="content">
        @if(isset($selectedGame))
            <div class="game-details">
                <h2>{{ $selectedGame->title }}</h2>
                <img src="{{ $selectedGame->cover_image }}" alt="{{ $selectedGame->title }}">
                <p>{{ $selectedGame->description }}</p>
                <p>Publisher: {{ $selectedGame->publisher }}</p>
                <p>Developer: {{ $selectedGame->developer }}</p>
                <p>Release Date: {{ $selectedGame->release_date }}</p>
            </div>
        @else
            <p>Select a game from your library to view details</p>
        @endif
    </div>
</div>    

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const gameItems = document.querySelectorAll('.sidebar ul li');
        gameItems.forEach(item => {
            item.addEventListener('click', function() {
                window.location.href = '/library?game=' + this.dataset.gameId;
            });
        });
    });
</script>
@endsection



@endsection