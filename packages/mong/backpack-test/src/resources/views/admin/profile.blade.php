@extends(backpack_view('blank'))

@section('content')
    <section class="header-operation container-fluid animated fadeIn d-flex mb-2 align-items-baseline d-print-none"
        bp-section="page-header">
        <h1 class="text-capitalize mb-0" bp-section="page-heading">Profile</h1>
    </section>
    <section class="content container-fluid animated fadeIn" bp-section="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        Go to <code>{{ $page }}</code> to edit this view or <code>{{ $controller }}</code> to edit
                        the controller.
                    </div>
                </div>
            </div>
        </div>
        <livewire:backpack-test.profile />
    </section>
@endsection
