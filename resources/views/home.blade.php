@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @auth
                        {{ __('You are logged in!') }}
                        @if (Route::has('slideredit') and auth()->user()->role === 'admin')
                            <a class="nav-link nav-item margin-5" href="{{ route('slideredit') }}">Dodaj zdjęcia</a>
                        @endif
                        @if (Route::has('CategoryEdit') and auth()->user()->role === 'admin')
                            <a class="nav-link nav-item margin-5" href="{{ route('CategoryEdit') }}">Dodaj Kategorie</a>
                        @endif
                        @if (Route::has('product.create') and auth()->user()->role === 'admin')
                            <a class="nav-link nav-item margin-5" href="{{ route('product.create') }}">Dodaj Produkt</a>
                        @endif
                        @if (Route::has('commentsAccept.index') and auth()->user()->role === 'admin')
                            <a class="nav-link nav-item margin-5" href="{{ route('commentsAccept.index') }}">Akceptuj komentarze</a>
                        @endif
                    @endauth

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
