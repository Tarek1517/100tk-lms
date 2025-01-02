<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CourseCategoryRequest;
use Illuminate\Support\Str;
use \App\Models\CourseCategory;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class CourseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $AllCategories = CourseCategory::with('parent')->orderBy('order_number')
            ->get();

        return Inertia::render('Dashboard/Category/index', [
            'allCategories' => $AllCategories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parentCategories = CourseCategory::where('parent_id', 0)
            ->get();

        return Inertia::render('Dashboard/Category/Add', [
            'parentCategories' => $parentCategories,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */


    public function store(CourseCategoryRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        if (is_null($data['parent_id'])) {
            $data['parent_id'] = 0;
        }
        if ($request->hasFile('image')) {
            $img_file = $request->file('image');
            $image_name = Str::random(20);
            $ext = strtolower($img_file->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;

            $path = $img_file->storeAs('img', $image_full_name, 'public');
            $data['image'] = $image_full_name;
        }



        $category = CourseCategory::create($data);

        return Inertia::location(route('category.index'));

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
    public function edit($id)
    {
        $editCategory = CourseCategory::findOrFail($id);
        $parentCategories = CourseCategory::where('parent_id', 0)
            ->get();

        return Inertia::render('Dashboard/Category/Edit', [
            'editCategory' => $editCategory,
            'parentCategories' => $parentCategories,
        ]);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(CourseCategoryRequest $request, $id)
    {
        $category = CourseCategory::findOrFail($id);
        $validated = $request->validated();
        $validated['parent_id'] = $validated['parent_id'] ?? 0;

        if ($request->hasFile('image')) {
            $image_name = Str::random(20) . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('img', $image_name, 'public');
            $validated['image'] = $image_name;
        } else {
            $validated['image'] = $category->image;
        }
        $category->update($validated);

        return Inertia::location(route('category.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = CourseCategory::findOrFail($id);

        if ($category->image) {
            Storage::disk('public')->delete('img/' . $category->image);
        }
        $category->delete();

        return Inertia::location(route('category.index'));
    }

}
