@props([
    'icon' => 'bi-telephone',
    'title' => 'Contact Title',
    'subtitle' => '',
    'mainText' => '',
    'description' => ''
])

<div class="contact-card p-4 text-center h-100" 
     style="border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); transition: transform 0.3s ease;">
    <div class="contact-icon mb-3" 
         style="width: 70px; height: 70px; border-radius: 50%; background-color: var(--light-pink); display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
        <i class="bi {{ $icon }}" style="font-size: 1.8rem; color: var(--dark-pink);"></i>
    </div>
    <h4>{{ $title }}</h4>
    @if($subtitle)
        <p class="text-muted">{{ $subtitle }}</p>
    @endif
    <h5 class="text-primary">{{ $mainText }}</h5>
    @if($description)
        <p class="mt-3">{{ $description }}</p>
    @endif
</div>