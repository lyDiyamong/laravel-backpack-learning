@php
$categories = \App\Models\Category::withCount('products')->get();
@endphp

<div class="card col-md-6">
    <div class="card-body">
        <h5 class="card-title">Category Summary</h5>
        <ul>
            @foreach($categories as $category)
                <li>{{ $category->name }} — {{ $category->products_count }} products</li>
            @endforeach
        </ul>
    </div>
</div>
