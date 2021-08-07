<?php

namespace App\Http\Controllers;

use App\Http\Requests\HomeSlider\HomeSliderRequest;
use App\Models\Brand;
use App\Models\HomeSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeSliderController extends Controller
{
    public function index()
    {
        // HomeSlider::truncate();
        $sliders = HomeSlider::latest()->paginate(10);
        return view('admin.slider.index', compact('sliders'));
    }

    public function store(HomeSliderRequest $request)
    {
        $data = [];
        $data['title'] = $request->input('title');
        $data['description'] = $request->input('description', null);

        $slider =  HomeSlider::create($data);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $name = genrateRandomNameForFile($file);
            Storage::disk('home-slider')->putFileAs('', $file, $name);
            $slider->path = $name;
            $slider->save();
        }

        return redirect()->route('admin.sliders.index')->with('success', $slider->title . ' added successfully');
    }

    public function edit($id)
    {
        $homeSlider = HomeSlider::findOrFail($id);
        return view('admin.slider.edit', compact('homeSlider'));
    }

    public function update(Request $request, $id)
    {
        $slider = HomeSlider::findOrFail($id);
        $slider->title = $request->title;
        $slider->description = $request->description;
        // $slider->save();

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $name = genrateRandomNameForFile($file);
            Storage::disk("home-slider")->putFileAs('', $file, $name);
            $slider->path = $name;
        }
        $slider->save();

        return redirect()->back()->with('success', 'Slider updated successfully');
    }


    public function delete($id)

    {
        $slider = HomeSlider::findOrFail($id);
        HomeSlider::deleteFileFromStorage($slider->path);
        $slider->delete();
        return redirect()->route('admin.sliders.index')->with('success', 'sldier deleted  successfully');
    }
}
