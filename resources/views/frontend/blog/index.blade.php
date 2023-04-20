@extends('layouts.app')

@section('title', 'Blog')

@section('content')

    <div class="row" style="margin-right: 0;">
        <div class="card-body">
            <h5>Welcome to the blog section!</h5>
            <p>Here you can read, post and comment on our user made recipes and other ideas.</p>
            <a href="/blog/create" class="btn btn-primary">Create</a>
        </div>
    </div>

    <div class="row" style="margin-right: 0;">
        <div class="col-md-10 bg-light">
            <h5 class="text-center pt-2">All Posts</h5>
            <div class="row text-center mr-2" style="margin-left: 2px;">
                @forelse($blogs as $item)
                    <div class="col-lg-3 col-md-3 col-6">
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="product-card shadow p-3 mb-2">
                                    <div class="product-card-img">
                                        <a href="{{ url('blog/'.$item->id) }}">
                                            <img src="{{ $item->image }}" class="card-img-top rounded" alt="..." style="width: 100%; height: 100%; object-fit: contain; margin: auto;">
                                        </a>
                                    </div>
                                    <br>
                                    <div class="product-card-body">
                                        <h6 id="blog-name" class="product-name">
                                            <a href="{{ url('blog/'.$item->id) }}">
                                                {{ $item->title }}
                                            </a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <h5 style="margin-left: 10px;">No Blogs Available</h5>
                @endforelse
            </div>
        </div>
        <div id="newest" class="col-md-2 bg-light" style="border-left: solid white 40px;">
            <h5 class="text-center pt-2">Newest Posts</h5>
            @forelse($newest as $item)
                <div class="col-12">
                    <div class="row mt-1">
                        <div class="col-12">
                            <div class="product-card shadow p-3 mb-2">
                                <div class="product-card-img">
                                    <a href="{{ url('blog/'.$item->id) }}">
                                        <img src="{{ $item->image }}" class="card-img-top rounded" alt="..." style="width: 100%; height: 100%; object-fit: contain; margin: auto;">
                                    </a>
                                </div>
                                <br>
                                <div class="product-card-body text-center">
                                    <h6 id="blog-name" class="product-name">
                                        <a href="{{ url('blog/'.$item->id) }}">
                                            {{ $item->title }}
                                        </a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h5 style="margin-left: 10px;">No New Blogs Available</h5>
            @endforelse
        </div>
    </div>
    <div style="padding-left: 15px;">
        {{ $blogs->links() }}
    </div>

    <style>
        @media (max-width: 1111px) {
            #newest {
                border-left: solid white 20px !important;
            }
        }
        @media (max-width: 990px) {
            #blog-name {
                font-size: 14px !important;
            }
            #newest {
                border-left: solid white 5px !important;
            }
        }
        @media (max-width: 767px) {
            #newest {
                border-left: 0 !important;
            }
            .col-md-10 {
                order: 2;
            }
            .col-md-2 {
                order: 1;
                margin-left: 5px !important;
            }
        }
    </style>

@endsection
