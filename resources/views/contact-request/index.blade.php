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
                    Contacts Request
                </h5>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Sr no</th>
                                <th scope="col">First name</th>
                                <th scope="col">Lastname</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($contactRequests as $contact)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $contact->first_name }}</td>
                                    <td>
                                        {{ $contact->last_name }}
                                    </td>
                                    <td>
                                        {{ $contact->subject }}
                                    </td>
                                    <td>
                                        {{ $contact->message }}
                                    </td>
                                    <td>{{ $contact->created_at->diffForHumans() }}</td>
                                    <td>

                                        <a class="btn btn-danger"
                                            href="{{ route('admin.contact-request.delete', ['id' => $contact->id]) }}">Delete</a>
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

                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="card">
                <h5 class="card-header">Add Contact Request</h5>
                <div class="card-body">

                    <form action="{{ route('admin.contact-request.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control m-2" id="Brads_name" aria-describedby="emailHelp"
                                name="first_name" placeholder="Enter first name">
                            @error('first_name')
                                <div class="mt-1 alert alert-danger alert-dismissable fade show">
                                    {{ $message }}
                                </div>
                            @enderror


                            <input type="text" class="form-control m-2" id="Brads_name" aria-describedby="emailHelp"
                                name="last_name" placeholder="Enter last name">
                            @error('last_name')
                                <div class="mt-1 alert alert-danger alert-dismissable fade show">
                                    {{ $message }}
                                </div>
                            @enderror
                            <input type="text" class="form-control m-2" id="Brads_name" aria-describedby="emailHelp"
                                name="subject" placeholder="Enter subject">
                            @error('subject')
                                <div class="mt-1 alert alert-danger alert-dismissable fade show">
                                    {{ $message }}
                                </div>
                            @enderror

                            <textarea type="text" class="form-control m-2" id="Brads_name" aria-describedby="emailHelp"
                                name="message" placeholder="Enter message">
                                                                                            </textarea>
                            @error('message')
                                <div class="mt-1 alert alert-danger alert-dismissable fade show">
                                    {{ $message }}
                                </div>
                            @enderror


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
