@extends('layout.layout')
@section('content')   
<link rel="stylesheet" href="{{asset('styles/game.css')}}">

    <div class="Game"> 
        <!-- Game header with title and path -->
        <div class="game-header">
            <div class="game-header-path"> General / {{ $selectedGame->base_game_tag}} | {{ $selectedGame->title }}</div>
            <h1>{{ $selectedGame->title }}</h1>
        </div>
        
        <!-- Main content with 2-column layout -->
        <div class="game-content">
            <!-- Left column: Trailer/video and thumbnails -->
            <div class="game-media">
                <div class="game-trailer">
                    @if($selectedGame->main_trailer_video)
                        <video src="{{ $selectedGame->mainTrailerUrl }}" poster="{{ $selectedGame->cover_image }}" style="height: auto; width: 100%;" id="main-trailer"></video>
                    @else
                        <img src="{{ $selectedGame->cover_image }}" alt="{{ $selectedGame->title }}" style="height: auto;">
                    @endif
                    <div class="media-controls">
                        <button id="play-button">▶</button>
                        <div class="progress-bar">
                            <div class="progress-fill"></div>
                        </div>
                        <div class="media-time">0:00 / 0:00</div>
                    </div>
                </div>
                
                <div class="thumbnails">
                    @if($selectedGame->main_trailer_video)
                    <div class="thumbnail video" data-video="{{ $selectedGame->mainTrailerUrl }}">
                        <img src="{{ $selectedGame->cover_image }}" alt="Main Trailer">
                    </div>
                    @endif
                    
                    @if($selectedGame->secondary_trailer_video)
                    <div class="thumbnail video" data-video="{{ $selectedGame->secondaryTrailerUrl }}">
                        <img src="{{ $selectedGame->cover_image }}" alt="Secondary Trailer">
                    </div>
                    @endif
                    
                    @foreach($selectedGame->gameImages as $index => $image)
                    <div class="thumbnail">
                        <img src="{{ $image }}" alt="Screenshot {{ $index + 1 }}">
                    </div>
                    @endforeach
                    
                    @if(empty($selectedGame->gameImages))
                        <div class="thumbnail">
                            <img src="{{ $selectedGame->cover_image }}" alt="Cover Image">
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Right column: Game details -->
            <div class="game-details">
                <div class="game-image">
                    <img src="{{ $selectedGame->cover_image }}" alt="{{ $selectedGame->title }}">
                </div>
                
                <!-- Review scores -->
                <div class="game-review-summary">
                    <div class="review-title">Critic Reviews</div>
                    @if(count($selectedGame->criticReviews) > 0)
                        <div class="review-scores">
                            @foreach($selectedGame->criticReviews as $index => $review)
                                <div class="review-score">
                                    <div class="score-value">{{ $review['score'] }}</div>
                                    <div class="score-label">{{ $review['name'] }}</div>
                                </div>
                                
                                @if(($index + 1) % 4 == 0 && $index + 1 < count($selectedGame->criticReviews))
                                    </div><div class="review-scores">
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div class="review-scores">
                            <div class="review-score">
                                <div class="score-value">{{ $selectedGame->review_score }}/10</div>
                                <div class="score-label">User Score</div>
                            </div>
                        </div>
                    @endif
                </div>
                
                <div class="game-metadata">
                    <p class="game-description">{{ $selectedGame->description }}</p>
                    <div class="game-specs">
                        <p><span>Publisher:</span> {{ $selectedGame->publisher }}</p>
                        <p><span>Developer:</span> {{ $selectedGame->developer }}</p>
                        <p><span>Release Date:</span> {{ $selectedGame->release_date }}</p>
                        <p><span>PGE Rating:</span> {{ $selectedGame->pge_rating }}</p>
                        <p><span>Review Score:</span> {{ $selectedGame->review_score }}</p>
                        <p><span>Price:</span> {{ $selectedGame->price }}€</p>
                    </div>
                    
                    <!-- Game tags -->
                    <div class="game-tags">
                        <div class="tags-title">Popular user-defined tags for this product:</div>
                        <div class="tags-list">
                            @if($selectedGame->base_game_tag)
                                <div class="tag">{{ $selectedGame->base_game_tag }}</div>
                            @endif
                            
                            @foreach($selectedGame->tagsArray as $tag)
                                <div class="tag">{{ $tag }}</div>
                            @endforeach
                            
                            @if(empty($selectedGame->tagsArray) && !$selectedGame->base_game_tag)
                                <div class="tag">Games</div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Purchase buttons -->
                    <form action="{{ route('buy.game', ['id' => $selectedGame->id ?? $selectedGame->game_id]) }}" method="POST" style="display: inline;">
                        @csrf
                        @php
                            $isOwned = DB::table('user_games')->where('user_id', auth()->id())->where('game_id', $selectedGame->game_id ?? $selectedGame->id)->exists();
                        @endphp
    
                        @if (!$isOwned)
                            <button type="submit" class="buy-button">Purchase</button>
                        @else
                            <button type="submit" class="buy-button1" disabled>Owned</button>
                        @endif
                    </form>
                    
                    @if ($isOwned)
                    <form action="{{ route('library') }}" method="get" style="display: inline;">
                        <button type="submit" class="buy-button">Show in library</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const mainDisplay = document.querySelector('.game-trailer');
    const thumbnails = document.querySelectorAll('.thumbnail');
    const playButton = document.getElementById('play-button');
    const progressBar = document.querySelector('.progress-fill');
    const mediaTime = document.querySelector('.media-time');
    
    // Main display content (video or image)
    let mainVideo = document.getElementById('main-trailer');
    let mainImage = mainDisplay.querySelector('img');
    
    // Function to update main display with video
    function displayVideo(videoSrc) {
        if (!mainVideo) {
            // Remove image if exists
            if (mainImage) {
                mainImage.remove();
            }
            
            // Create new video element
            mainVideo = document.createElement('video');
            mainVideo.id = 'main-trailer';
            mainVideo.src = videoSrc;
            mainVideo.style.height = 'auto';
            mainVideo.style.width = '100%';
            mainVideo.poster = '{{ $selectedGame->cover_image }}';
            
            // Add video element to main display
            mainDisplay.insertBefore(mainVideo, mainDisplay.firstChild);
            
            // Set up video event listeners
            setupVideoEvents();
        } else {
            // Update existing video
            mainVideo.src = videoSrc;
        }
        
        // Reset UI
        playButton.textContent = '▶';
        progressBar.style.width = '0%';
        mediaTime.textContent = '0:00 / 0:00';
    }
    
    // Function to update main display with image
    function displayImage(imageSrc, altText) {
        // Pause and remove video if exists
        if (mainVideo) {
            mainVideo.pause();
            mainVideo.remove();
            mainVideo = null;
        }
        
        // Create or update image
        if (!mainImage) {
            mainImage = document.createElement('img');
            mainImage.style.height = 'auto';
            mainImage.alt = altText || 'Game screenshot';
            mainDisplay.insertBefore(mainImage, mainDisplay.firstChild);
        }
        
        mainImage.src = imageSrc;
    }
    
    // Set up video event listeners
    function setupVideoEvents() {
        if (mainVideo) {
            // Time update event
            mainVideo.addEventListener('timeupdate', function() {
                // Update progress bar
                const percent = (mainVideo.currentTime / mainVideo.duration) * 100;
                progressBar.style.width = percent + '%';
                
                // Update time display
                const currentMinutes = Math.floor(mainVideo.currentTime / 60);
                const currentSeconds = Math.floor(mainVideo.currentTime % 60);
                const durationMinutes = Math.floor(mainVideo.duration / 60) || 0;
                const durationSeconds = Math.floor(mainVideo.duration % 60) || 0;
                
                mediaTime.textContent = `${currentMinutes}:${currentSeconds.toString().padStart(2, '0')} / ${durationMinutes}:${durationSeconds.toString().padStart(2, '0')}`;
            });
            
            // Click on progress bar to seek
            document.querySelector('.progress-bar').addEventListener('click', function(e) {
                const percent = e.offsetX / this.offsetWidth;
                mainVideo.currentTime = percent * mainVideo.duration;
            });
        }
    }
    
    // Click play button
    if (playButton) {
        playButton.addEventListener('click', function() {
            if (mainVideo) {
                if (mainVideo.paused) {
                    mainVideo.play();
                    playButton.textContent = '❚❚';
                } else {
                    mainVideo.pause();
                    playButton.textContent = '▶';
                }
            }
        });
    }
    
    // Click on thumbnails
    thumbnails.forEach(function(thumbnail) {
        thumbnail.addEventListener('click', function() {
            const isVideo = this.classList.contains('video');
            
            if (isVideo) {
                const videoSrc = this.getAttribute('data-video');
                if (videoSrc) {
                    displayVideo(videoSrc);
                }
            } else {
                const imgSrc = this.querySelector('img').src;
                const altText = this.querySelector('img').alt;
                displayImage(imgSrc, altText);
            }
            
            // Highlight selected thumbnail
            thumbnails.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
        });
    });
    
    // Initialize video controls if video exists
    if (mainVideo) {
        setupVideoEvents();
    }
});
</script>

@endsection