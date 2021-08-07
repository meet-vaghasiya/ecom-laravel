@extends('layouts.app')

@section('title', 'Multi image list')

@section('content')
    <div class="row my-5">
        <div class="col-md-8">
            <div class="row">
                @foreach ($multiImages as $image)
                    <div class="col-md-4 my-3">
                        <img src="{{ Storage::disk('multi-image')->url($image->path) }}" alt="" height="100px">

                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <h5 class="card-header">Add Images</h5>
                <div class="card-body">

                    <form action="{{ route('admin.multi-image.index') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">

                            <input type="file" name="avatar[]" placeholder="Choose logo" class="form-control mt-3" multiple>

                            @error('avatar.*')
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
