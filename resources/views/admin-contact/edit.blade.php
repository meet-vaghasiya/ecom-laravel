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
                <h5 class="card-header">Edit Contact</h5>
                <div class="card-body">

                    <form action="{{ route('admin.contact.update', ['id' => $adminContact->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control m-2" id="Brads_name" aria-describedby="emailHelp"
                                name="address" placeholder="Enter address" value="{{ $adminContact->address }}">
                            @error('address')
                                <div class="mt-1 alert alert-danger alert-dismissable fade show">
                                    {{ $message }}
                                </div>
                            @enderror


                            <input type="text" class="form-control m-2" id="Brads_name" aria-describedby="emailHelp"
                                name="email" placeholder="Enter email" value="{{ $adminContact->email }}">
                            @error('email')
                                <div class="mt-1 alert alert-danger alert-dismissable fade show">
                                    {{ $message }}
                                </div>
                            @enderror
                            <input type="text" class="form-control m-2" id="Brads_name" aria-describedby="emailHelp"
                                name="phone" placeholder="Enter phone" value="{{ $adminContact->phone }}">
                            @error('phone')
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
