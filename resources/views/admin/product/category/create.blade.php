@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Add Category</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Create Category</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.category.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" />
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option @selected(old('status') === 1) value="1">Active</option>
                            <option @selected(old('status') !== 1) value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Show At Home</label>
                        <select name="show_at_home" class="form-control">
                            <option @selected(old('show_at_home') === 1) value="1">Active</option>
                            <option @selected(old('show_at_home') !== 1) value="0">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </section>
@endsection
