@extends('layouts.app')

@section('content')
    <div class="MainShopContainer">
        <ul class="CategoriesMenuList">
            <ul class="category">
                @each('shop.categories.category', $parentCategories, 'category')
            </ul>
        </ul>
        <div class="ProductsList">
                <div class="productShowDiv">
                    <div class="productShow">
                        <div class="productPhoto">

                            <div class="product-slider-box">
                                <div class="ProductSliderContainer">
                                    <div class="Product-wrapper">
                                        <ul class="Product-list">
                                            @foreach($product->photos as $image)
                                                <img class="image-item" src="http://127.0.0.1:8000/{{$image->path}}" alt="img">
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="ProductSlider-scrollbar">
                                        <div class="product-scrollbar-track">
                                            <div class="product-scrollbar-thumb"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="divFlexCenter">
                            <div class="productDesc">
                                @auth
                                    <form method="POST" style="display: flex; flex-wrap: wrap;" action="{{route('cart.update', -1)}}">
                                        {{csrf_field()}}
                                        {{method_field('PUT')}}
                                        <input type="hidden" name="quantityFactor" value="increase">
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
                                <h2><b>{{ $product->name }}</b></h2>
                                <p><b>Kategoria:</b>   &#160;&#160;{{ $product->category->name }} </p>
                                <p style="text-decoration: underline;"><b>Cena:</b>   &#160;&#160;{{ $product->price }}zł</p>
                                <p><b>Opis:</b> <br>
                                <div class="productDesc noBorder" >{{ $product->description }}</p></div>
                            </div>
                        </div>

                    </div>
                    @auth
                        <div class="comments-section">
                            <div class="card-header">Comments:</div>
                            <form class="FormCenter" action="{{ route('comments.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <label for="comment_text">Dodaj komentarz:</label>
                                <textarea class="CommentTextArea" name="comment_text" id="comment_text" cols="30" rows="5"></textarea>
                                <button class="save_order_button" type="submit">Dodaj komentarz</button>
                            </form>
                            <ul class="CommentsList">
                                <ul class="comment">
                                    @each('shop.products.comment', $parentComments, 'comment')
                                </ul>
                            </ul>
                        </div>
                    @endauth
                </div>
        </div>
    </div>
    <script src="{{asset('scripts/ProductSlider.js')}}"></script>
    <script>
        function toggleReplyForm(button) {
            const replyContainer = button.nextElementSibling;
            replyContainer.style.display = (replyContainer.style.display === 'none' || replyContainer.style.display === '') ? 'block' : 'none';
        }
    </script>
@endsection
