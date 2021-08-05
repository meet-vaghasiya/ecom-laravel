@extends('layouts.app')

@section('title', 'Category list')


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
                    Categories
                </h5>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Sr no</th>
                                <th scope="col">Name</th>
                                <th scope="col">User</th>
                                <th scope="col">Create At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($categories as $category )
                                <tr>
                                    <th scope="row">{{ $categories->firstItem() + $loop->index }}</th>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->user ? $category->user->name : '' }}</td>
                                    <td>{{ $category->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a class="btn btn-primary"
                                            href="{{ route('admin.categories.edit', ['id' => $category->id]) }}">Edit</a>
                                        <a class="btn btn-danger"
                                            href="{{ route('admin.categories.delete', ['id' => $category->id]) }}">Delete</a>
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

                        {{ $categories->links() }}
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="card">
                <h5 class="card-header">Add category</h5>
                <div class="card-body">

                    <form action="{{ route('admin.categories.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control" id="category_name" aria-describedby="emailHelp"
                                name="name" placeholder="Category name">
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
    <div class="row">
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
                    Trashed category
                </h5>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Sr no</th>
                                <th scope="col">Name</th>
                                <th scope="col">User</th>
                                <th scope="col">Create At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($onlyTrashedCategory as $category )
                                <tr>
                                    <th scope="row">{{ $categories->firstItem() + $loop->index }}</th>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->user ? $category->user->name : '' }}</td>
                                    <td>{{ $category->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a class="btn btn-primary"
                                            href="{{ route('admin.categories.restore', ['id' => $category->id]) }}">Restore</a>
                                        <a class="btn btn-danger"
                                            href="{{ route('admin.categories.force-delete', ['id' => $category->id]) }}">Force
                                            Delete</a>
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

                        {{ $onlyTrashedCategory->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
