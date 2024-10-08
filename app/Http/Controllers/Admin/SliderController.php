<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SliderCreateRequest;
use App\Http\Requests\Admin\SliderUpdateRequest;
use App\Models\Slider;
use App\Traits\FileUploadTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class SliderController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(SliderDataTable $dataTable): View|JsonResponse
    {
        return $dataTable->render('admin.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderCreateRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $validatedData['image'] = $this->uploadImage($request, 'image');

        Slider::create($validatedData);

        return redirect(route('admin.slider.index'))->with([
            'status' => 'slider-created',
            'message' => "Slider created successfully",
            'alert-type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider): View
    {
        return view('admin.slider.edit', ['slider' => $slider]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderUpdateRequest $request, Slider $slider): RedirectResponse
    {
        $validatedData = $request->validated();

        if(!empty($validatedData['image']) && $validatedData['image'] !== $slider->image) {
            $validatedData['image'] = $this->uploadImage($request, 'image', $slider->image);
        }

        $slider->update($validatedData);

        return redirect(route('admin.slider.index'))->with([
            'status' => 'slider-updated',
            'message' => "Slider updated successfully",
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider): Response
    {
        try {
            $this->removeImage($slider->image);
            $slider->delete();

            return response([
                'status' => 'success',
                'message' => 'Slide deleted successfully',
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
