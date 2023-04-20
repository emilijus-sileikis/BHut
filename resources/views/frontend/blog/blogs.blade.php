@extends('layouts.app')

@section('title', 'My Blog View')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                @if(session('message'))
                    <div class="alert alert-success" id="session-message">{{ session('message') }}</div>
                    <script>
                        setTimeout(function() {
                            document.getElementById('session-message').style.display = 'none';
                        }, 5000);
                    </script>
                @endif


                <div class="card">
                    <div class="card-header">
                        <h3>Posts
                            <a href="/blog/create" class="btn btn-primary btn-sm text-white float-right align-content-center"> Create Post </a>
                        </h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($blogs as $item)
                                <tr>
                                    <td>{{ $item->title }}</td>
                                    <td><img src="{{ url($item->image) }}" class="card-img-top rounded mx-auto d-block" alt="..." style="width: 100px; height: 100px; object-fit: contain; margin: auto;"></td>
                                    <td>
                                        <a href="{{ url('blogs/'.$item->id.'/edit') }}" class="btn btn-success">Edit</a>
                                        <a href="{{ url('blogs/'.$item->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this post?')" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">No Posts Available</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
