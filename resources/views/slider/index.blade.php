@extends('layouts.app')

@section('title', 'Brand list')

@section('content')
    <div class="row my-5">
        <div class="col-md-8">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card">
                <h5 class="card-header">
                    Brands
                </h5>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Sr no</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Image</th>
                                <th scope="col">Create At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($sliders as $slider)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $slider->title }}</td>
                                    <td>{{ $slider->description }}</td>
                                    <td>
                                        <img src="{{ Storage::disk('home-slider')->url($slider->path) }}" alt=""
                                            height="70px">
                                    </td>
                                    <td>{{ $slider->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a class="btn btn-primary"
                                            href="{{ route('admin.sliders.edit', ['id' => $slider->id]) }}">Edit</a>
                                        <a class="btn btn-danger"
                                            href="{{ route('admin.sliders.delete', ['id' => $slider->id]) }}">Delete</a>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td>No data available</td>
                                </tr>

                            @endforelse
                        </tbody>
                    </table>
                    <div class="" style="float: right">

                        {{ $sliders->links() }}
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="card">
                <h5 class="card-header">Add Sliders</h5>
                <div class="card-body">

                    <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control" id="title" aria-describedby="emailHelp" name="title"
                                placeholder="Title">
                            @error('title')
                                <div class="mt-1 alert alert-danger alert-dismissable fade show">
                                    {{ $message }}
                                </div>
                            @enderror
                            <textarea type="text" class="form-control" id="description" aria-describedby="emailHelp"
                                name="description" placeholder="Add description"></textarea>
                            @error('description')
                                <div class="mt-1 alert alert-danger alert-dismissable fade show">
                                    {{ $message }}
                                </div>
                            @enderror

                            <input type="file" name="avatar" placeholder="Choose logo" class="form-control mt-3">

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
