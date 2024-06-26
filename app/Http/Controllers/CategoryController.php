<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
    use App\Models\Category;

class CategoryController extends Controller
{

public function index()
{
    $categories = Category::all();
    return view('category.index', compact('categories'));
}

public function create()
{
    return view('category.create');
}

public function add(Request $request)
{
    $check = Category::where('name', trim($request->name))->first();
        if ($check != null) {
            return back()->with('error', "name of product already exists");
        }
    // dd($request);
    $category = new Category();
    $category->name = $request->input('name');
    $category->save();

    return redirect('category/index')->with('success', 'Category created successfully.');
}

public function edit(Category $category)
{
    return view('categories.edit', compact('category'));
}

public function update(Request $request, Category $category)
{
    $category->name = $request->input('name');
    $category->save();

    return redirect()->route('category.index')->with('success', 'Category updated successfully.');
}


}
