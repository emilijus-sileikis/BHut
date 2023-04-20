@extends('layouts.app')

@section('title', 'Blog')

@section('content')

    <div class="container">
        <div class="row">
            <h5 class="text-center">Update the post</h5>
        </div>
        <div class="row">
            <div class="mt-2">
                <form method="post" action="{{ url('blogs/'.$blog->id.'/update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-md-12 mb-3">
                        <label for="title" class="fw-bold">Title: </label>
                        <input type="text" id="title" name="title" class="form-control" value="{{ $blog->title }}" maxlength="50" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="fw-bold">Image (MAX: 4MB):</label>
                        <input type="file" name="image" class="form-control">
                        <img src="{{ asset("$blog->image") }}" class="img-fluid img-thumbnail" style="height: 20%; width: 20%; border-radius: 0.25rem; text-align: center;" alt="Blog">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="myTextarea" class="fw-bold">Description:</label>
                        <textarea id="myTextarea" name="content">{!! $blog->descr !!}</textarea>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary float-end">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        tinymce.init({
            selector: "textarea",
            plugins: 'wordcount',
            toolbar: 'wordcount',
            setup: function(editor) {
                var max = 5000;
                editor.on('submit', function(event) {
                    var numChars = tinymce.activeEditor.plugins.wordcount.body.getCharacterCount();
                    if (numChars > max) {
                        alert("Maximum " + max + " characters allowed.");
                        event.preventDefault();
                        return false;
                    }
                })
            }
        });

        document.querySelector('form').addEventListener('submit', function() {
            document.getElementById('myTextarea').value = tinymce.get('myTextarea').getContent();
        });
    </script>

@endsection
