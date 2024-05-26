<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Http\Traits\ImageUpload;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    use ImageUpload;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::filter($request->query())->paginate(1);
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
        $data['image'] = $this->uploadImage($request, 'uploads/categories/');
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
        $newImage = $this->uploadImage($request, 'uploads/categories/', $category->image);
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
        // $this->deleteImage($category->image);

        return redirect()->route('categories.index')->with('success_message', 'Category has been deleted successfully!');
    }

    /**
     * Display a listing of the trashed resources.
     */
    public function trash(Request $request)
    {
        $categories = Category::onlyTrashed()->paginate(1);

        return view('admin.pages.categories.trash', compact('categories'));
    }

    public function restore($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->route('categories.index')->with('success_message', 'Category has been restored successfully!');
    }

    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $this->deleteImage($category->image);
        $category->forceDelete();

        return redirect()->route('categories.index')->with('success_message', 'Category has been deleted permanently!');
    }
}
