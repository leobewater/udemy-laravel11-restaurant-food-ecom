<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ProductGalleryController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => ['required', 'image', 'max:3072'],
            'product_id' => ['required', 'integer']
        ]);
        $validatedData['image'] = $this->uploadImage($request, 'image');

        ProductGallery::create($validatedData);

        return back()->with([
            'status' => 'created',
            'message' => "Image uploaded successfully",
            'alert-type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.product.gallery.show', [
            'product' => $product,
            'images' => ProductGallery::where('product_id', $product->id)->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        try {
            $gallery = ProductGallery::findOrFail($id);
            $this->removeImage($gallery->image);
            $gallery->delete();

            return response([
                'status' => 'success',
                'message' => 'Image deleted successfully',
                'alert-type' => 'success'
            ]);
        } catch (\Exception $e) {
            return response([
                'status' => 'error',
                'message' => 'Failed to delete item',
                'alert-type' => 'error'
            ]);
        }


    }
}
