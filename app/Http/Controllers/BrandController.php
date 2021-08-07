<?php

namespace App\Http\Controllers;

use App\Http\Requests\Brand\StoreRequest;
use App\Http\Requests\Brand\UpdateRequest;
use App\Models\Brand;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::latest()->paginate(10);
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $brand = Brand::create([
            'name' => $request->input('name'),
        ]);

        if ($request->hasFile('logo')) {
            $brandLogoFile = $request->file('logo');

            $randomName = Str::random(20);
            $originalExtension = $brandLogoFile->getClientOriginalExtension();
            $storeAs = $randomName . '.' . $originalExtension;

            Storage::disk('brands')->putFileAs('', $brandLogoFile, $storeAs);
            $brand->path = $storeAs;
            $brand->save();
        }
        return redirect()->route('admin.brands.index')->with('success', $brand->name . 'created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $brand = Brand::find($id);
        $brand->name = $request->name;
        $brand->save();

        if ($request->hasFile('logo')) {
            $brandLogoFile = $request->file('logo');

            $randomName = Str::random(20);
            $originalExtension = $brandLogoFile->getClientOriginalExtension();
            $storeAs = $randomName . '.' . $originalExtension;
            Storage::disk('brands')->delete($brand->path);  // add conditito that if file exists than only remove or delte

            $brand->path  = $storeAs;
            $brand->save();
            Storage::disk('brands')->putFileAs('', $brandLogoFile, $storeAs);
        }

        return redirect()->back()->with('success', $brand->name . ' updated succesfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $brand = Brand::findOrFail($id);
        Storage::disk('brands')->delete($brand->path);

        $brand =  $brand->delete();
        return redirect()->route('admin.brands.index')->with('success', '');
    }
}
