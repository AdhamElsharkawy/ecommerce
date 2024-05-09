<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Traits\ImageUpload;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Admin\CreateCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;

class CategoryController extends Controller
{
    use ImageUpload;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.pages.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.pages.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCategoryRequest $request)
    {
        $data = $request->validated();

        $data['slug'] = Str::slug($data['name']);
        $data['image']  = $this->uploadImage($request, 'uploads/categories/');

        Category::create($data);
        return Redirect::route('categories.index')->with('success', 'Category has been added successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $categories = Category::where('id', '!=', $category->id)->where(function ($query) use ($category) {
            $query->whereNull('parent_id')->orWhere('parent_id', '!=', $category->id);
        })->get();

        //if not found any category return back with error message
        if (!$category) {
            return Redirect::back()->with('error', 'Category not found!');
        }

        return view('admin.pages.categories.edit', compact('category', 'categories'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);
        $newImage  = $this->uploadImage($request, 'uploads/categories/', $category->image);
        if ($newImage !== null) {
            $data['image'] = $newImage;
        }

        $category->update($data);
        return redirect()->route('categories.index')->with('success_message', 'Category has been updated successfully!');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        $this->deleteImage($category->image);

        return redirect()->route('categories.index')->with('success_message', 'Category has been deleted successfully!');
    }
}
