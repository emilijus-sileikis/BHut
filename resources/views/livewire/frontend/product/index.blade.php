<div id="products-wrapper">
    <div class="row" id="products-list">

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
        <div>
            {{ $products->links() }}
        </div>
    </div>
</div>
