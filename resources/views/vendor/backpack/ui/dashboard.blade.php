@extends(backpack_view('blank'))

@php
    $widgets['before_content'][] = [
        'type'       => 'card',
        'content'    => ['header' => 'Quick Actions', 'body' => '<a href="#">Export Data</a>'],
        'wrapper'    => ['class' => 'col-md-4 mt-4'],
    ];
    $widgets['before_content'] = [
        'type'       => 'livewire',
        'content'    => "backpack-test.profile",
        'wrapper'    => ['class' => 'col-md-4 mt-4'],
    ];
@endphp

@section('content')
@endsection