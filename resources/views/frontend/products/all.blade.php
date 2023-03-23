@extends('layouts.app')

@section('content')

    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header" style="background: rgba(235, 169, 55, 1);"><h4>Filter By</h4></div>
                        <div class="card-body" style="background: rgba(235, 169, 55, 0.5);">
                            <form method="GET" action="{{ route('products.all') }}">
                                <label class="custom-label"><input class="custom-checkbox" type="checkbox" name="category[]" value="all" id="all-categories" {{ !request()->has('category') || in_array('all', (array) request('category')) ? 'checked' : '' }}> All Categories</label><br>
                                @foreach ($categories as $category)
                                    <label class="custom-label"><input class="custom-checkbox category-checkbox" type="checkbox" name="category[]" value="{{ $category->id }}" {{ in_array($category->id, (array) request('category')) ? 'checked' : '' }}> {{ $category->name }}</label><br>
                                @endforeach
                                <br>
                                <label class="custom-label" for="price_sort">Sort by price:</label>
                                <select name="price_sort" id="price_sort">
                                    <option value="">Select</option>
                                    <option value="asc" {{ request('price_sort') == 'asc' ? 'selected' : '' }}>Low to High</option>
                                    <option value="desc" {{ request('price_sort') == 'desc' ? 'selected' : '' }}>High to Low</option>
                                </select>
                                <br><br>
                                <label class="custom-label" for="qty_sort">Sort by quantity:</label>
                                <select name="qty_sort" id="qty_sort">
                                    <option value="">Select</option>
                                    <option value="asc" {{ request('qty_sort') == 'asc' ? 'selected' : '' }}>Low to High</option>
                                    <option value="desc" {{ request('qty_sort') == 'desc' ? 'selected' : '' }}>High to Low</option>
                                </select>
                                <br><br>
                                <button class="btn btn-primary" type="submit">Filter</button>
                                <button class="btn btn-dark" type="button" id="clear-filter">Clear</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="mb-4">All Products</h4>
                        </div>

                        @forelse($products as $item)
                            <div class="col-md-3">
                                <div class="product-card">
                                    <div class="product-card-img">

                                        @if($item->quantity > 0)
                                            <label class="stock bg-success">In Stock</label>
                                        @else
                                            <label class="stock bg-danger">Out Of Stock</label>
                                        @endif

                                            <label class="stock bg-success" style="position: relative; float: right;">{{$item->quantity}}</label>

                                        @if($item->images->count() > 0)
                                            <a href="{{ url('categories/'.$item->category->slug.'/'.$item->slug) }}">
                                                <img src="{{ asset($item->images[0]->image) }}" alt="{{ $item->name }}">
                                            </a>
                                        @endif
                                    </div>
                                    <div class="product-card-body">
                                        <h5 class="product-name">
                                            <a href="{{ url('categories/'.$item->category->slug.'/'.$item->slug) }}">
                                                {{ $item->name }}
                                            </a>
                                        </h5>
                                        <div>
                                            <span class="selling-price">{{$item->selling_price}}€</span>
                                            <span class="original-price">{{$item->original_price}}€</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-md-12">
                                <h5>No Products Available</h5>
                            </div>
                        @endforelse
                    </div>
                    <div>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Checkboxes
        const allCategoriesCheckbox = document.querySelector('#all-categories');
        const categoryCheckboxes = document.querySelectorAll('.category-checkbox');

        allCategoriesCheckbox.addEventListener('change', () => {
            // If All Categories is checked uncheck all other checkboxes
            if (allCategoriesCheckbox.checked) {
                categoryCheckboxes.forEach((checkbox) => {
                    checkbox.checked = false;
                });
            }
        });

        categoryCheckboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', () => {
                // If other category is checked uncheck All Categories
                if (checkbox.checked) {
                    allCategoriesCheckbox.checked = false;
                }
            });
        });

        // Clear button
        const clearFilterButton = document.querySelector('#clear-filter');

        clearFilterButton.addEventListener('click', () => {
            // Reset the price
            document.querySelector('#price_sort').value = '';
            document.querySelector('#qty_sort').value = '';

            // Reset All Cats
            allCategoriesCheckbox.checked = true;

            // Uncheck other checkboxes
            categoryCheckboxes.forEach((checkbox) => {
                checkbox.checked = false;
            });

            // Update the URL
            window.location.href = "{{ route('products.all') }}";
        });
    </script>

@endsection
