<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
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

    public function uploadImage($request, $path, $old_image = null)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path($path);
            if ($old_image != null && file_exists(public_path($old_image))) {
                unlink($old_image);
            }

            $image->move($destinationPath, $image_name);
            //get image with full path
            return $path . $image_name;
        }
        return null;
    }


    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $categories = Category::all();
        return view('admin.pages.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        // dd($request->validated());
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
        return redirect()->route('categories.index')->with('success_message', 'Category has been deleted successfully!');
    }
}
