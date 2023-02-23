@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">

            @if(session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3>Sliders
                        <a href="{{ url('admin/sliders/create') }}" class="btn btn-primary btn-sm text-white float-right align-content-center"> Add Slider </a>
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($sliders as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>
                                        <img src="{{ asset("$item->image") }}" class="img-fluid img-thumbnail" style="height: 120px; width: 300px; border-radius: 0.25rem; text-align: center;" alt="Slider">
                                    </td>
                                    <td>{{ $item->status == '0' ? 'Visible':'Hidden' }}</td>
                                    <td>
                                        <a href="" class="btn btn-success">Edit</a>
                                        <a href="" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
