<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\WhyChooseUsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WhyChooseUsCreateRequest;
use App\Models\SectionTitle;
use App\Models\WhyChooseUs;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class WhyChooseUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(WhyChooseUsDataTable $dataTable): View | JsonResponse
    {
        $keys = ['why_choose_top_title', 'why_choose_main_title', 'why_choose_sub_title'];
        $titles = SectionTitle::whereIn('key', $keys)->pluck('value', 'key');
        // dd($titles);

        return $dataTable->render('admin.why-choose-us.index', [
            'titles' => $titles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.why-choose-us.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WhyChooseUsCreateRequest $request): RedirectResponse
    {
        // dd($request->all());
        WhyChooseUs::create($request->validated());

        return redirect(route('admin.why-choose-us.index'))->with([
            'status' => 'why-choose-us-created',
            'message' => "Item created successfully",
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
    public function edit(string $id): View
    {
        $whyChooseUs = WhyChooseUs::findOrFail($id);

        return view('admin.why-choose-us.edit', [
            'whyChooseUs' => $whyChooseUs
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateTitle(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'why_choose_top_title' => ['nullable', 'string', 'max:100'],
            'why_choose_main_title' => ['nullable', 'string', 'max:200'],
            'why_choose_sub_title' => ['nullable', 'string', 'max:500']
        ]);

        SectionTitle::updateOrCreate(
            ['key' => 'why_choose_top_title'],
            ['value' => $validatedData['why_choose_top_title'] ?? null]
        );
        SectionTitle::updateOrCreate(
            ['key' => 'why_choose_main_title'],
            ['value' => $validatedData['why_choose_main_title'] ?? null]
        );
        SectionTitle::updateOrCreate(
            ['key' => 'why_choose_sub_title'],
            ['value' => $validatedData['why_choose_sub_title'] ?? null]
        );

        return back()->with([
            'status' => 'updated',
            'message' => "Updated successfully",
            'alert-type' => 'success'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WhyChooseUsCreateRequest $request, string $id): RedirectResponse
    {
        $whyChooseUs = WhyChooseUs::findOrFail($id);
        $whyChooseUs->update($request->validated());

        return redirect(route('admin.why-choose-us.index'))->with([
            'status' => 'updated',
            'message' => "Updated successfully",
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        try {
            $whyChooseUs = WhyChooseUs::findOrFail($id);
            $whyChooseUs->delete();

            return response([
                'status' => 'success',
                'message' => 'Item deleted successfully',
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
