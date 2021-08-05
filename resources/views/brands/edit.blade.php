@extends('layouts.app')

@section('title', "{$brand->name} edit")


@section('content')
    <div class="row mt-5">
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
                <h5 class="card-header">Edit brand</h5>
                <div class="card-body">
                    <form action=" {{ route('admin.brands.update', ['id' => $brand->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control" id="Brads_name" aria-describedby="emailHelp" name="name"
                                placeholder="Brads name" value="{{ $brand->name }}">
                            @error('name')
                                <div class="mt-1 alert alert-danger alert-dismissable fade show">
                                    {{ $message }}
                                </div>
                            @enderror

                            <input type="file" name="logo" placeholder="Choose logo" class="form-control mt-3">

                            <img src="{{ Storage::disk('brands')->url($brand->path) }}" alt="" height="200px"
                                class="mt-3">

                            @error('logo')
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
