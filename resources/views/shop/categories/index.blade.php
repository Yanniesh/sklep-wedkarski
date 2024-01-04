@extends('layouts.app')

@section('content')
    <div class="contentFlex">
        <h2 class="card-header">Lista kategorii</h2>
        <div class="div-FormCenter FormCenter">
            <form class="FormCenter" method="POST" action="{{route('CategoryEdit.store')}}">
                @csrf
                <div class="labelXinput">
                    <label style="font-size: 2rem;" for="categorySelect">Wybierz kategorię:</label>
                    <select id="categorySelect" name="categorySelect">
                        <option value="0"  selected>Nowa Kategoria</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                        <label for="categoryName">Nazwa nowej kategorii:</label>
                        <input type="text" id="categorySelect" name="categoryName" required>
                        <button class="margin-5 nav-item submitfoty" type="submit">Dodaj kategorię</button>
                @if (session('status'))
                    <div class="alert alert-success"  style="color:lightgreen;" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div>-------------------------------</div>
            </form>
        </div>
    </div>

@endsection
