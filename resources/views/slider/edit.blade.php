@extends('layouts.app')

@section('title', 'Brand list')

@section('content')
    <div class="row my-5">

        <div class="col-md-8">
            <div class="card">
                <h5 class="card-header">Edit Sliders</h5>
                <div class="card-body">

                    <form action="{{ route('admin.sliders.update', ['id' => $homeSlider->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control" id="title" aria-describedby="emailHelp" name="title"
                                placeholder="Title" value="{{ $homeSlider->title ?? null }}">
                            @error('title')
                                <div class="mt-1 alert alert-danger alert-dismissable fade show">
                                    {{ $message }}
                                </div>
                            @enderror
                            <textarea type="text" class="form-control" id="description" aria-describedby="emailHelp"
                                name="description"
                                placeholder="Edit description">{{ $homeSlider->description ?? null }}</textarea>
                            @error('description')
                                <div class="mt-1 alert alert-danger alert-dismissable fade show">
                                    {{ $message }}
                                </div>
                            @enderror

                            <input type="file" name="avatar" placeholder="Choose logo" class="form-control mt-3">
                            <img class="mt-2" src="{{ Storage::disk('home-slider')->url($homeSlider->path) }}" alt=""
                                height="200px">

                            @error('avatar')
                                <div class="mt-1 alert alert-danger alert-dismissable fade show">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <button type="submit" class="btn btn-primary float-end">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
