@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>"{{ $product->name }}" Product Gallery</h1>
        </div>

        <div>
            <a href="{{ route('admin.product.index') }}" class="btn btn-secondary mb-4">Go Back</a>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Upload Images</h4>
            </div>
            <div class="card-body">
                <div class="col-md-8">
                    <form action="{{ route('admin.product-gallery.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="file" name="image" class="form-control" />
                            <input type="hidden" name="product_id" value="{{ $product->id }}" />
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card card-primary">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($images as $image)
                            <tr>
                                <td>
                                    <img width="80" src="{{ asset($image->image) }}" />
                                </td>
                                <td>
                                    <a href="{{ route('admin.product-gallery.destroy', $image->id) }}"
                                        class='btn delete-item'><i class='far fa-trash-alt'></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center">No images found!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
