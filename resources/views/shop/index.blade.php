@extends('layouts.app')

@section('content')
<div class="MainShopContainer">
    <ul class="CategoriesMenuList">
            <ul class="category">
{{--                @php--}}
{{--                dd($backCategory->id);--}}

{{--                @endphp--}}
                @if($backCategory != null)
                    <div class="CategoryDeleteForm">
                            <a style="color: coral; margin-left: -10px; padding: 5px; " href="{{ route('shop', ['category' => $backCategory->id]) }}">Cofnij</a>
                    </div>
                @elseif(request()->has('category'))
                    <div class="CategoryDeleteForm">
                        <a style="color: coral; margin-left: -10px; padding: 5px; " href="{{ route('shop') }}">Cofnij</a>
                    </div>
                @endif

                @each('shop.categories.category', $parentCategories, 'category')
            </ul>

    </ul>
    <div class="ProductsList">
        @if (session('status'))
            <div class="alert alert-success" style="color: yellow; margin: 20px; padding: 10px; border: solid black 2px" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @foreach ($products as $product)
            <div class="product">
                <div class="productPhoto" onclick="redirectToProduct({{ $product->id }})">
                    @foreach($product->photos->take(2) as $image)
                        <img class="" src="http://127.0.0.1:8000/{{$image->path}}" alt="img">
                    @endforeach
                </div>
                <div class="productDesc">
                    @auth
                        <form method="POST" style="display: flex; flex-wrap: wrap;" action="{{route('cart.update', -1)}}">
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                            <input type="hidden" name="productId" value="{{$product->id}}">
                            <button class="save_order_button">Dodaj do koszyka!</button>
                        </form>
                    @if(auth()->user()['role']=="admin" or auth()->user()['id'] == $product->owner->id)
                        <form method="POST" action="{{route('product.destroy', $product->id)}}">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button class="save_order_button">Usuń produkt</button>
                        </form>
                    @endif
                    @endauth
                    <h2>{{ $product->name }}</h2>
                    <p>Sprzedawca:   &#160;&#160;{{ $product->owner->name }} </p>
                    <p>Kategoria:   &#160;&#160;{{ $product->category->name }} </p>
                    <p style="color: lightgreen;">Cena:   &#160;&#160;{{ $product->price }}zł</p>
                    <p>Opis: <br>  {{ $product->description }}</p>
                </div>
            </div>
        @endforeach
            <div class="paginatediv">  {{ $products->links( "pagination::bootstrap-4") }} </div>
    </div>

</div>
<script>
    function redirectToProduct(productId) {
        window.location.href = '{{ url("shop/product/") }}' + '/' + productId;
    }
</script>
@endsection
