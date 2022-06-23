@extends('layouts.admin')

@section('content')

<div class="container-fluid px-5">

    @include('partials.message')
    @include('partials.errors')

    <div class="row">
        <div class="col-4">
            <h2 class="py-3">Add New Category</h2>
            <form class="d-flex align-items-center" action="{{route('admin.categories.store')}}" method="post">
                @csrf
                <div class="mr-3">
                    <label for="name" class="form-label mb-0">Name</label>
                    <input type="text" class="form-control" name="name" id="name" aria-describedby="helpIdName" placeholder="insert category name">
                    <small id="helpIdName" class="form-text text-muted">insert category name</small>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary mx-1 text-white">Add</button>
                </div>
            </form>
        </div>

        <div class="col-8">
            <h2 class="py-3">All Categories</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Post Count</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td scope="row">{{$category->id}}</td>
                        <td>
                            <form id="form-categories-{{$category->id}}" action="{{route('admin.categories.update',$category->slug)}}" method="post">
                                @csrf
                                @method('PATCH')
                                <input class="border-0 bg-transparent" type="text" name="name" id="name" value="{{$category->name}}">
                            </form>
                        </td>
                        <td>{{$category->slug}}</td>
                        <td><span class="badge badge-info bg-dark">{{count($category->posts)}}</span></td>
                        <td class="d-flex">
                        
                        <button form="form-categories-{{$category->id}}" type="submit" class="btn btn-success text-white mx-1">Update</button>
                        <!-- delete -->
                        <form action="{{route('admin.categories.destroy',$category->slug)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger text-white">Delete</button>
                        </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td scope="row">No categories</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection