@props(['story', 'index'])

<div class="col-lg-4 col-md-6" data-category="{{ $story['category'] }}">
    <div class="story-card" onclick="openStoryModal({{ $index }})">
        <img src="{{ $story['image'] }}" alt="{{ $story['couple'] }}" class="story-image">
        <div class="story-content">
            <div class="story-quote">"{{ Str::limit($story['quote'], 150) }}"</div>
            
            <div class="story-couple">
                <img src="{{ $story['avatar'] }}" alt="{{ $story['couple'] }}" class="couple-avatar">
                <div class="couple-info">
                    <h4>{{ $story['couple'] }}</h4>
                    <p>{{ $story['profession'] }}</p>
                    <p><i class="bi bi-geo-alt"></i> {{ $story['location'] }}</p>
                </div>
            </div>
            
            <div class="story-meta">
                <div class="story-date">
                    <i class="bi bi-calendar"></i>
                    {{ $story['date'] }}
                </div>
                <a href="#" class="read-more" onclick="event.preventDefault();">
                    Read Full Story <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>