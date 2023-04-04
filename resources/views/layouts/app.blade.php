<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BHut') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    @livewireStyles
</head>
<body>
    <div id="app">

        <div class="gradient">

            @include('layouts.inc.frontend.navbar')

            <main class="py-4">
                <div>
                    @yield('content')
                </div>
                <div>
                    @yield('categories')
                </div>
                <br>
                <div>
                    @yield('newProducts')
                </div>
                <br><br><br>
            </main>

            @include('layouts.inc.frontend.footer')

        </div>

    </div>
    <!-- Scripts -->
    <script src="{{ asset('assets/js/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Other scripts -->
    <script>
        var cartCountUrl = "{{ route('cart.count') }}";
        var wishlistCountUrl = "{{ route('wishlist.count') }}";
    </script>
    <script src="{{ asset('js/cart.js') }}"></script>
    <script src="{{ asset('js/wishlist.js') }}"></script>

    @livewireScripts
</body>
</html>
