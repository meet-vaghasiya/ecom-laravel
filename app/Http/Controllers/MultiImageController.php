<?php

namespace App\Http\Controllers;

use App\Http\Requests\MultiImage\StoreRequeset;
use App\Models\MultiImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class MultiImageController extends Controller
{
    public function index()
    {
        $multiImages =  MultiImage::get();

        return view('admin.multi-image.index', compact('multiImages'));
    }

    public function store(StoreRequeset $request)
    {

        foreach ($request->avatar as $image) {
            $random = Str::random(20);
            $ext = $image->getClientOriginalExtension();
            $fullName = $random . '.' . $ext;
            MultiImage::create([
                'path' => $fullName
            ]);
            Storage::disk('multi-image')->putFileAS('', $image, $fullName);
        }

        return redirect()->route('admin.multi-image.index')->with('success', 'Image uploaded succesfully');
    }
}
