<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    function index() {
        return view('category.index')->with('categories', Category::all());
    }

    function create() {
        return view('category.create');
    }

    function store(Request $request) {
        Category::create([
            'name' => $request->name
        ]);
        return redirect(route('category.index'));
    }

    function edit(Category $category) {
        return view('category.edit')->with('category', $category);
        //dd($category);
    }

    function update(Category $category, Request $request) {
        $category->update(['name'=>$request->name]);
        return redirect(route('category.index'));
    }

    function destroy(Category $category) {
        $category->delete();
        return redirect(route('category.index'));
    }
}
