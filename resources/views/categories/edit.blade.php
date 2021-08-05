@extends('layouts.app')

@section('title', "{$category->name} edit")


@section('content')
    <div class="row mt-5">

        <div class="col-md-8">
            <div class="card">
                <h5 class="card-header">Edit category</h5>
                <div class="card-body">
                    <form action=" {{ route('admin.categories.update', ['id' => $category->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control" id="category_name" aria-describedby="emailHelp"
                                name="name" value="{{ old('name', $category->name) }}">
                            @error('name')
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
