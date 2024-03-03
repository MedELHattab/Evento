<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->paginate(5);
        return view('categories.index', compact('categories'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()

    {

        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {

        if ($request->image) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $path = 'uploads/categories/';
            $file->move($path, $fileName);
            Category::create([
                'name' => $request->name,
                'description' => $request->description,
                'image' => $fileName,
            ]);
        } else {
            Category::create([
                'name' => $request->name,
                'description' => $request->description,

            ]);
        }
        return redirect()->route('categories')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $categories)
    {
        return view('categories.show', compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        if ($request->image) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $path = 'uploads/categories/';
            $file->move($path, $fileName);
            $category->update([
                'name' => $request->name,
                'description' => $request->description,
                'image' => $fileName,
            ]);
        } else {
            $category->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);
        }


        return redirect()->route('categories')
            ->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories')
            ->with('success', 'category deleted successfully');
    }

    public function archive()
    {
        $categories = Category::onlyTrashed()->latest()->paginate(5);
        return view('categories.archive', compact('categories'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
