<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\EditRequest;
use App\Http\Requests\Category\StoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->paginate(5);
        $onlyTrashedCategory = Category::onlyTrashed()->latest()->paginate(3);
        return view('categories.index', compact('categories', 'onlyTrashedCategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $category = Category::create([
            'name' => $request->input('name'),
            'user_id' => Auth::id()
        ]);
        return redirect()->route('admin.categories.index')->with('success', $category->name . ' category create successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)

    {
        $category = Category::findOrFail($id);

        return view('categories.edit', compact('category'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $oldName = $category->name;
        $category->name = $request->name;
        $category->user_id = Auth::id();
        $category->save();
        return redirect()->route('admin.categories.index')->with('success', $oldName . ' category updaetd successfully to ' . $category->name . '.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $category = Category::destroy($id);
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted succesfully.');
    }

    public function restore($id)
    {
        $category = Category::withTrashed()->find($id)->restore();
        return redirect()->route('admin.categories.index')->with('success', 'Category restore succesfully.');
    }
    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->find($id)->forceDelete();
        return redirect()->route('admin.categories.index')->with('success', 'Category delete perminent succesfully.');
    }
}
