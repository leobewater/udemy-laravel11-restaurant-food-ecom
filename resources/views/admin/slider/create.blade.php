@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Add Slider</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Card Header</h4>
            </div>
            <div class="card-body">
                <form action="">
                    <div class="form-group">
                        <label>Image</label>
                        <div id="image-preview" class="image-preview">
                            <label for="image-upload" id="image-label">Choose File</label>
                            <input type="file" name="image" id="image-upload" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Offer</label>
                        <input type="text" name="offer" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="text" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Sub Title</label>
                        <input type="text" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Short Description</label>
                        <textarea class="form-control" name="short_description"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Button Link</label>
                        <input type="text" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control">
                            <option value="1">Enable</option>
                            <option value="0">Disable</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </section>
@endsection
