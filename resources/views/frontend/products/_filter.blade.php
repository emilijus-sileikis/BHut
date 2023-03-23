<div class="card">
    <div class="card-header" style="background: rgba(235, 169, 55, 1);"><h4>Filter By</h4></div>
    <div class="card-body" style="background: rgba(235, 169, 55, 0.5);">
        <form id="filter-form" method="GET" action="{{ route('products.all') }}">
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
