@props(['video'])

<div class="col-lg-4 col-md-6">
    <div class="video-story-card" onclick="playVideo('{{ $video['id'] }}')">
        <div class="video-container">
            <img src="{{ $video['thumbnail'] }}" alt="{{ $video['title'] }}" class="video-thumbnail">
            <div class="play-button">
                <i class="bi bi-play-fill"></i>
            </div>
        </div>
        <div class="video-content">
            <h4>{{ $video['title'] }}</h4>
            <div class="video-couple">
                <i class="bi bi-people"></i>
                <span>{{ $video['couple'] }}</span>
            </div>
            <p class="mt-3">{{ Str::limit($video['description'], 100) }}</p>
        </div>
    </div>
</div>