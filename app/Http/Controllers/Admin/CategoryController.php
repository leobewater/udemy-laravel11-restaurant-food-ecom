<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryCreateRequest;
use App\Http\Requests\Admin\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.product.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.product.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryCreateRequest $request): RedirectResponse
    {
        // dd($request->all());
        $validatedData = $request->validated();
        $validatedData['slug'] = Str::slug($validatedData['name']);

        Category::create($validatedData);

        return redirect(route('admin.category.index'))->with([
            'status' => 'created',
            'message' => "Category created successfully",
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
    public function edit(Category $category): View
    {
        return view('admin.product.category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        // dd($request->all());
        $validatedData = $request->validated();
        if(!empty($validatedData['name']) && $validatedData['name'] !== $category->name) {
            $validatedData['slug'] = Str::slug($validatedData['name']);
        }

        $category->update($validatedData);

        return redirect(route('admin.category.index'))->with([
            'status' => 'updated',
            'message' => "Category updated successfully",
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();

            return response([
                'status' => 'success',
                'message' => 'Category deleted successfully',
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
