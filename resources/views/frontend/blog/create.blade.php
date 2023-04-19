@extends('layouts.app')

@section('title', 'Blog')

@section('content')

    <div class="container">
        <div class="row">
            <h5 class="text-center">Create a recipe</h5>
        </div>
        <div class="row">
            <div class="mt-2">
                <form method="post" action="{{ url('blog/post') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12 mb-3">
                        <label for="title" class="fw-bold">Title: </label>
                        <input type="text" id="title" name="title" class="form-control" maxlength="50" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="fw-bold">Image (MAX: 4MB):</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="myTextarea" class="fw-bold">Description:</label>
                        <textarea id="myTextarea" name="content"></textarea>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary float-end">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        tinymce.init({
            selector: 'textarea'
        });

        document.querySelector('form').addEventListener('submit', function() {
            document.getElementById('myTextarea').value = tinymce.get('myTextarea').getContent();
        });
    </script>

@endsection
