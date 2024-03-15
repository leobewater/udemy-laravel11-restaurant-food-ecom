@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Add Why Choose Us Item</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Create Item</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.why-choose-us.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label>icon</label>
                        <button class="btn btn-primary" data-iconset="fontawesome5" data-icon="fas fa-wifi" role="iconpicker"></button>

                        <input type="text" name="icon" class="form-control" value="{{ old('icon') }}" />
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" />
                    </div>
                    <div class="form-group">
                        <label>Short Description</label>
                        <textarea name="short_description" class="form-control">{{ old('short_description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option @selected(old('status') === 1) value="1">Active</option>
                            <option @selected(old('status') !== 1) value="0">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" @disabled($errors->isNotEmpty())>Create</button>
                </form>
            </div>
        </div>
    </section>
@endsection
