@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Why Choose Us?</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>All Why Choose Us</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.why-choose-us.create') }}" class="btn btn-primary">
                        Add New
                    </a>
                </div>
            </div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
