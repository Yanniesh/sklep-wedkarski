<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Barber') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css" >
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0"/>
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="display-container">
        <header>
            <div class="sliderbox">
            <div class="sliderContainer">
                <div class="slider-wrapper">
                    <ul class="image-list">
                        @if(count(App\Models\photos_orders::all()) == 0 or is_null(App\Models\photos_orders::find(1)->ids_order) or App\Models\photos_orders::find(1)->ids_order == "null"))
                            <img class="image-item" src="https://t4.ftcdn.net/jpg/04/73/25/49/360_F_473254957_bxG9yf4ly7OBO5I0O5KABlN930GwaMQz.jpg" alt="img-1"/>
                            <img class="image-item" src="https://t4.ftcdn.net/jpg/04/73/25/49/360_F_473254957_bxG9yf4ly7OBO5I0O5KABlN930GwaMQz.jpg" alt="img-2"/>
                            <img class="image-item" src="https://t4.ftcdn.net/jpg/04/73/25/49/360_F_473254957_bxG9yf4ly7OBO5I0O5KABlN930GwaMQz.jpg" alt="img-3"/>
                            <img class="image-item" src="https://t4.ftcdn.net/jpg/04/73/25/49/360_F_473254957_bxG9yf4ly7OBO5I0O5KABlN930GwaMQz.jpg" alt="img-3"/>
                        @else
                            @php
                                $sliderOrder = App\Models\photos_orders::find(1);
                                if ($sliderOrder->ids_order != "null") {
                                    $orderIds = json_decode($sliderOrder->ids_order);

                                    $sliderPhotos = [];
                                    foreach ($orderIds as $photoId) {
                                        $photo = App\Models\SliderPhoto::find($photoId);
                                        if ($photo) {
                                            $sliderPhotos[] = $photo;
                                        }
                                    }

                                    foreach ($sliderPhotos as $image) {
                                        echo '<img class="image-item" src="http://127.0.0.1:8000/' . $image->imagePath . '" alt="img">';
                                    }
                                }
                            @endphp

                        @endif
                    </ul>
                </div>
                <div class="slider-scrollbar">
                    <div class="scrollbar-track">
                        <div class="scrollbar-thumb"></div>
                    </div>
                </div>
            </div>
            </div>
            <div class="menu">
            <div class="logo">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Barber') }}
                </a>
                <button id="themeToggleBtn">Toggle Theme</button>

            </div>
            <nav class="navbar">
                        <ul class="navbar-list">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('shop') }}">{{ __('Sklep') }}</a>
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
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('cart.index') }}">Koszyk</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('shop.orders.index') }}">Zamówienia</a>
                                </li>
                                <li class="nav-item">
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                                        @csrf
                                        <a class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="">
                                            {{ __('Logout') }}
                                        </a>
                                    </form>
                                </li>
                                <li class="username-TextLi">
                                    <a class="username-Text" href="/home" role="button">
                                        {{ Auth::user()->name }}
                                    </a>
                                </li>
                                
                            @endguest
                        </ul>
            </nav>
            </div>
        </header>
        <main class="main-div">
            @yield('content')
        </main>
        <footer>
          <div class="copyright">
              Copyright@2011
          </div>
        </footer>
    </div>
    <script src="{{asset('scripts/slider.js')}}"></script>
    <script src="{{asset('scripts/themeToggle.js')}}"></script>
</body>
</html>
