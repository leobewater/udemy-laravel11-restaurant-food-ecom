@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Why Choose Us Item</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Edit Item</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.why-choose-us.update', $whyChooseUs->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>icon</label>
                        <br>
                        <button class="btn btn-primary btn-lg" data-iconset="fontawesome5"
                            data-icon="{{ old('icon') ?? $whyChooseUs->icon }}" data-cols="6" data-rows="6"
                            data-unselected-class="btn-default" role="iconpicker" name="icon"></button>
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control"
                            value="{{ old('title') ?? $whyChooseUs->title }}" />
                    </div>
                    <div class="form-group">
                        <label>Short Description</label>
                        <textarea name="short_description" class="form-control">{{ old('short_description') ?? $whyChooseUs->short_description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option @selected($whyChooseUs->status === 1) value="1">Active</option>
                            <option @selected($whyChooseUs->status === 0) value="0">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" @disabled($errors->isNotEmpty())>Create</button>
                </form>
            </div>
        </div>
    </section>
@endsection
