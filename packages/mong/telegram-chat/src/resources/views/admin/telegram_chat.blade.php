@extends(backpack_view('blank'))



@php
    // Define a group of widgets
    $widgetGroup = [
        'type' => 'div',
        'class' => 'row widget-group mb-4', // Add your preferred styling classes
        'content' => [
            // Second widget in group
            [
                'type' => 'livewire',
                'content' => 'telegram-chat.telegram-user-list',
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
<section class="header-operation container-fluid animated fadeIn d-flex mb-2 align-items-baseline d-print-none" bp-section="page-header">
    <h1 class="text-capitalize mb-0" bp-section="page-heading">Telegram Chat</h1>
    <p class="ms-2 ml-2 mb-0" bp-section="page-subheading">Page for Telegram Chat</p>
</section>
@endsection
