@extends(backpack_view('blank'))

@php
    // Define a group of widgets
    $widgetGroup = [
        'type' => 'div',
        'class' => 'row widget-group mb-4', // Add your preferred styling classes
        'content' => [
            // First widget in group
            [
                'type' => 'card',
                'wrapper' => ['class' => 'col-sm-3 col-md-3'],
                "class" => 'card bg-dark text-white',
                'content' => ['header' => 'Quick Actions', 'body' => '<p class="text-white">Export Data</p>'],
            ],
            // Second widget in group
            [
                'type' => 'livewire',
                'content' => 'backpack-test.profile',
                'parameters' => [
                    'name' => 'John Doe',
                    'count' => 10,
                ],
            ],
        ],
    ];

    // Add the entire group as a single widget
    $widgets['after_content'][] = $widgetGroup;
@endphp

@section('content')
    {{-- Header Section --}}
    <section class=" animated fadeIn ">
        <h2 class="text-2xl font-semibold mb-4">Dashboard Overview</h2>
    </section>
    
    {{-- Widgets Section --}}
@endsection
