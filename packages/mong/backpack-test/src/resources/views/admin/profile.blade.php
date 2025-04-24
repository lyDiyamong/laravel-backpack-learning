@extends(backpack_view('blank'))

@section('content')
    <section class="header-operation container-fluid animated fadeIn d-flex mb-2 align-items-baseline d-print-none"
        bp-section="page-header">
        <h1 class="text-capitalize mb-0" bp-section="page-heading">Profile</h1>
    </section>
    <section class="content container-fluid animated fadeIn" bp-section="content">
        <livewire:backpack-test.profile name="John Doe" />
    </section>
@endsection
