@extends('layouts.app')

@section('title', 'Blog')

@section('content')

    <div class="container">
        <div class="row">
            <h5 class="text-center">{{ $blog->title }}</h5>
            <h6 class="text-center"> (By: {{ $blog->user->name }}) </h6>
        </div>
        <div class="row">
            <div class="mt-2">
                <div class="col-md-12 mb-3">
                    <img src="{{ url($blog->image) }}" class="card-img-top rounded mx-auto d-block shadow border-dark" alt="..." style="width: 50%; height: 50%; object-fit: contain; margin: auto;">
                </div>
                <div class="col-md-6 mb-3 mx-auto d-block">
                    <div class="card">
                        <div class="card-body">
                            {!! $blog->descr !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <p>Uploaded at: {{ $blog->created_at->format('Y-m-d') }}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Comments</h4>
                    </div>
                    <form action="{{ route('blog.comment', $blog->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea name="content" class="form-control" placeholder="Leave a comment" maxlength="255" required></textarea>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                    <hr>
                    @foreach($blog->comments as $comment)
                        <div class="mb-2" style="margin-left: 5px;">
                            @if(Auth::id() == $comment->user_id)
                                <form method="POST" action="{{ route('blog.delete_comment', $comment->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm float-end" style="margin-right: 5px;"><i class="fas fa-trash"></i></button>
                                </form>
                            @endif
                            <strong>{{ $comment->user->name }}</strong>
                            <p>{{ $comment->content }}</p>
                            <small class="text-muted">{{ $comment->created_at->format('F j, Y g:i a') }}</small>
                        </div>
                        <div style="border: solid lightgray 1px; margin-bottom: 10px;"></div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
