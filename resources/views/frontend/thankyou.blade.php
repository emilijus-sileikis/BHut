@extends('layouts.app')

@section('title', 'Thank You For Shopping')

@section('content')

    <div class="py-3 pyt-md-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div>@include('layouts.inc.frontend.logo')</div> <br>
                    <h4>Thanks For Shopping At Bhut!</h4> <br>
                    <a href="{{ url('/') }}" class="btn btn-primary">Return Home</a>
                </div>
            </div>
        </div>
    </div>

@endsection
