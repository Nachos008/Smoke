@extends('layout.layout')
@section('content')   
<link rel="stylesheet" href="{{asset('styles/profile.css')}}">

<div class="profile-container">
    <div class="profile-header">
        <div class="profile-info">
            <div class="profile-avatar">
                <div class="avatar-circle">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
            </div>            <div class="profile-details">
                <h1 class="username">{{ $user->name }}</h1>
                <p class="member-since">Member since {{ \Carbon\Carbon::parse($user->created_at)->format('F Y') }}</p>
                <div class="profile-stats">
                    <div class="stat">
                        <span class="stat-number">{{ $games->count() }}</span>
                        <span class="stat-label">Games Owned</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="profile-content">
        <div class="section">
            <h2 class="section-title">My Game Library</h2>
            <div class="games-grid">
                @forelse($games as $game)
                    <div class="game-card" onclick="viewGame({{ $game->game_id ?? $game->id }})">                        <div class="game-image">
                            @if($game->cover_image)
                                <img src="{{ $game->cover_image }}" alt="{{ $game->title }}">
                            @else
                                <div class="placeholder-image">
                                    <span>{{ strtoupper(substr($game->title, 0, 2)) }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="game-info">                            <h3 class="game-title">{{ $game->title }}</h3>
                            <p class="game-developer">{{ $game->developer ?? 'Unknown Developer' }}</p>
                            @if($game->pivot && $game->pivot->purchased_at)
                                <p class="purchase-date">Added {{ \Carbon\Carbon::parse($game->pivot->purchased_at)->format('M j, Y') }}</p>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="empty-library">
                        <div class="empty-icon">🎮</div>
                        <h3>No games in your library</h3>
                        <p>Start building your collection by visiting the store!</p>
                        <a href="{{ route('store') }}" class="store-button">Browse Store</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script>
    function viewGame(gameId) {
        window.location.href = `/library?game=${gameId}`;
    }
</script>

@endsection