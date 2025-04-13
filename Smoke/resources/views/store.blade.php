@extends('layout.layout')
@section('content')
<div id="libraryContainer">
    @foreach($games as $game)
    <article>
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
</div>

<link rel="stylesheet" href="{{asset('styles/store.css')}}">

<button id="homeButton" onclick="scrollToTop()">Home</button>

<script>
    function scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
</script>
@endsection