<div class="main-navbar shadow-sm sticky-top">
    <div class="top-navbar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 my-auto d-none d-sm-none d-md-flex align-items-center">
                    <a href="{{ url('/') }}" style="text-decoration: none;">
                        <div class="d-flex align-items-center">
                            <h5 class="brand-name mb-0">{{ config('app.name', 'BHut') }}</h5>
                            @include('layouts.inc.frontend.logo')
                        </div>
                    </a>
                </div>
                <div class="col-md-5 my-auto">
                    <form action="{{ url('search') }}" method="POST" role="search">
                        @csrf
                        <div class="input-group">
                            <input type="search" name="search" id="search-input" value="{{ Request::get('search') }}" placeholder="Search for something..." class="form-control" maxlength="50"/>
                            <button class="btn bg-white" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-5 my-auto">
                    <ul class="nav justify-content-end">

                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('cart') }}">
                                <i class="fa fa-shopping-cart"></i> Cart (<span id="cart-count">0</span>)
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('wishlist') }}">
                                <i class="fa fa-heart"></i> Wishlist (<span id="wishlist-count">0</span>)
                            </a>
                        </li>
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                        @else
                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-user"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#"><i class="fa fa-user"></i> Profile</a></li>
                                <li><a class="dropdown-item" href="/orders"><i class="fa fa-list"></i> My Orders</a></li>
                                <li><a class="dropdown-item" href="/wishlist"><i class="fa fa-heart"></i> My Wishlist</a></li>
                                <li><a class="dropdown-item" href="/cart"><i class="fa fa-shopping-cart"></i> My Cart</a></li>
                                <li><a class="dropdown-item" href="/blogs"><i class="fa fa-pen"></i> My Posts</a></li>
                                @if(Auth::user()->role_as == '1')
                                    <li><a class="dropdown-item" href="{{ url('admin/dashboard') }}"><i class="fa fa-chart-pie"></i> Dashboard</a></li>
                                @endif
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a href="{{ url('/') }}" class="d-md-none d-lg-none" style="text-decoration: none;">
                <div class="d-flex align-items-center">
                    <h5 class="brand-name mb-0">{{ config('app.name', 'BHut') }}</h5>
                    @include('layouts.inc.frontend.logo')
                </div>
            </a>
                <div class="float-right d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" onclick="myFunction(this)">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/categories') }}">All Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/products/all') }}">All Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/blog') }}">Blog</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<script>
    function myFunction(x) {
        x.classList.toggle("change");
    }
</script>

<script>
    document.querySelector('form').addEventListener('submit', function (event) {
        const searchInput = document.getElementById('search-input');
        searchInput.value = searchInput.value.trim(); // Remove extra spaces

        if (searchInput.value === '') {
            event.preventDefault(); // Prevent form submission if empty
            alert('Please enter a search term.');
        } else {
            const regex = /^[a-zA-Z0-9\s\-\.,]+$/; // Allow alphanumeric, spaces, hyphens, periods, and commas

            if (!regex.test(searchInput.value)) {
                event.preventDefault(); // Prevent form submission if input contains harmful characters
                alert('Please use only alphanumeric characters, spaces, hyphens, periods, and commas.');
            } else {
                searchInput.value = searchInput.value.replace(/</g, "&lt;").replace(/>/g, "&gt;"); // Encode special characters
            }
        }
    });
</script>
