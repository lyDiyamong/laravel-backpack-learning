@php
    // Default attributes for stylesheets
    $widget['rel'] = $widget['rel'] ?? 'stylesheet';

    // Get the href from various possible sources
    $href = asset($widget['href'] ?? ($widget['content'] ?? $widget['path']));

    // Get additional attributes
    $attributes = collect($widget)
        ->except(['name', 'section', 'type', 'stack', 'href', 'content', 'path'])
        ->toArray();
@endphp

@push($widget['stack'] ?? 'after_styles')
    {{-- Include Backpack styles --}}
    @basset($href, true, $attributes, 'style')

    {{-- Include Vite compiled assets (including Tailwind) --}}
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endpush
