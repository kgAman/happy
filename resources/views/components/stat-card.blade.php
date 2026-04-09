@props(['count', 'label'])

<div class="stat-card">
    <div class="stat-number" data-count="{{ $count }}">0</div>
    <div class="stat-label">{{ $label }}</div>
</div>