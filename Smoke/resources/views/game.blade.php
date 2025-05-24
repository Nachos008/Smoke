@extends('layout.layout')
@section('content')   
<link rel="stylesheet" href="{{asset('styles/game.css')}}">

    <div class="Game"> 
        <div id="game-details-container">
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
                                <p><span>PGE Rating:</span> {{ $selectedGame->pge_rating }}</p>
                                <p><span>Review Score:</span> {{ $selectedGame->review_score }}</p>
                            </div>
                            <form action="{{ route('buy.game', ['id' => $selectedGame->id ?? $selectedGame->game_id]) }}" method="POST" style="display: inline;">
                                @csrf
                                @php
                                    $isOwned = DB::table('user_games')->where('user_id', auth()->id())->where('game_id', $selectedGame->game_id ?? $selectedGame->id)->exists();
                                @endphp
            
                                @if (!$isOwned)
                                    <button type="submit" class="buy-button">Purchase</button>
                                @else
                                    <p><button type="submit" class="buy-button1" disabled>Owned</button></p>
                                    @endif
                                </form>
                                 @if ($isOwned)
                                <form  action="{{ route('library') }}" method="get" style="display: inline;">
                                    <p><button type="submit" class="buy-button">Show in library</button></p>
                                </form>
                                @endif
                        </div>
                    </div>
                </div>
        </div>
    </div>
    </div>

@endsection