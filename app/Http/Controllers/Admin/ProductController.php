<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductCreateRequest;
use App\Http\Requests\Admin\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Traits\FileUploadTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ProductController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $dataTable): View|JsonResponse
    {
        return $dataTable->render('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.product.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCreateRequest $request): RedirectResponse
    {
        $imagePath = $this->uploadImage($request, 'image');

        $validatedData = $request->validated();

        Product::create([
            ...$validatedData,
            'thumb_image' => $imagePath,
            'category_id' => $validatedData['category'],
            'offer_price' => $validatedData['offer_price'] ?? 0,
            'slug' => generateUniqueSlug('Product', $validatedData['name']),
        ]);

        /*
        $product = new Product();
        $product->thumb_image = $imagePath;
        $product->name = $request->name;
        $product->slug = generateUniqueSlug('Product', $request->name);
        $product->category_id = $request->category;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price ?? 0;
        $product->quantity = $request->quantity;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->sku = $request->sku;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;
        $product->show_at_home = $request->show_at_home;
        $product->status = $request->status;
        $product->save();
        */

        return redirect(route('admin.product.index'))->with([
            'status' => 'created',
            'message' => "Product created successfully",
            'alert-type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        return view('admin.product.edit', [
            'categories' => Category::all(),
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, Product $product): RedirectResponse
    {
        $validatedData = $request->validated();

        if(!empty($validatedData['image']) && $validatedData['name'] !== $product->thumb_image) {
            $validatedData['thumb_image'] = $this->uploadImage($request, 'image', $product->image);
        }

        if(!empty($validatedData['name']) && $validatedData['name'] !== $product->name) {
            $validatedData['slug'] = generateUniqueSlug('Product', $validatedData['name']);
        }

        $product->update([
            ...$validatedData,
            'category_id' => $validatedData['category'],
            'offer_price' => $validatedData['offer_price'] ?? 0,
        ]);

        return redirect(route('admin.product.index'))->with([
            'status' => 'updated',
            'message' => "Product updated successfully",
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): Response
    {
        try {
            $this->removeImage($product->thumb_image);
            $product->delete();

            return response([
                'status' => 'success',
                'message' => 'Product deleted successfully',
                'alert-type' => 'success'
            ]);
        } catch (\Exception $e) {
            return response([
                'status' => 'error',
                // 'message' => $e->getMessage(),
                'message' => 'Failed to delete item',
                'alert-type' => 'error'
            ]);
        }
    }
}
