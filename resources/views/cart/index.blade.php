@extends('layouts.app')

@section('content')
    @php
        $totalAmount = 0;
    @endphp
    <div style="width: 60%;">
        <div class="card-header">Koszyk:</div>
        <table class="Cart-Products-List">
            <thead>
            <tr>
                <th class="CartItem-Atr">Nazwa</th>
                <th class="CartItem-Atr">Cena</th>
                <th class="CartItem-Atr">Ilość</th>
                <th class="CartItem-Atr">Łączny Koszt</th>
                <th class="CartItem-Atr">Usuń produkt</th>
            </tr>
            </thead>
            <tbody>
            @foreach($carts as $cart)
                <tr>
                    <td class="CartItem-Atr ClickPointer"
                        onclick="redirectToProduct({{ $cart->product_id }})">{{ $cart->product->name }}</td>
                    <td class="CartItem-Atr">{{ $cart->product->price }}</td>
                    <td class="CartItem-Atr">
                        <div style="display:flex; justify-content: center; align-items: center">
                            <form method="POST" action="{{route('cart.update', $cart->id)}}">
                                {{csrf_field()}}
                                {{method_field('PUT')}}
                                <input type="hidden" name="productId" value="{{$cart->product->id}}">
                                <input type="hidden" name="quantityFactor" value="decrease">
                                <button class="QuantityButton">-</button>
                            </form>
                            <div style="align-self: center; padding: 8px;">
                                {{ $cart->quantity }}
                            </div>
                            <form method="POST" action="{{route('cart.update', $cart->id)}}">
                                {{csrf_field()}}
                                {{method_field('PUT')}}
                                <input type="hidden" name="productId" value="{{$cart->product->id}}">
                                <input type="hidden" name="quantityFactor" value="increase">
                                <button class="QuantityButton">+</button>
                            </form>
                        </div>
                    </td>
                    <td class="CartItem-Atr">{{ $cart->amount }}</td>
                    <td class="CartItem-Atr">
                        <form method="POST" action="{{route('cart.destroy', $cart->id)}}">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button style="text-align: center; font-size: 2rem;" class="CategoryDeleteButton">X</button>
                        </form>

                    </td>
                </tr>
                @php
                    $totalAmount += $cart->amount;
                @endphp
            @endforeach
            </tbody>
        </table>
        Do zapłaty: {{ $totalAmount }}
        <form class="OrderForm" method="POST" action="{{route('shop.orders.store')}}">
            {{csrf_field()}}
            <input type="hidden" name="amount" value="{{ $totalAmount }}">
            <table class="OrderForm">
                <tbody class="OrderFormBody">
                <tr>
                    <td>
                        <label for="name">Imię</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required placeholder="Imię">
                    </td>
                </tr>
                <tr class="Label-Input">
                    <td>
                        <label for="surname">Nazwisko</label>
                        <input id="surname" type="text" name="surname" value="{{ old('surname') }}" required placeholder="Nazwisko">
                    </td>
                </tr>
                <tr class="">
                    <td>
                        <label for="postalCode">Kod Pocztowy</label>
                        <input id="postalCode" type="text" name="postalCode" value="{{ old('postalCode') }}" pattern="\d{2}-\d{3}" required placeholder="__-___">
                    </td>
                </tr>
                <tr class="">
                    <td>
                        <label for="city">Miasto</label>
                        <input id="city" type="text" name="city" value="{{ old('city') }}" required placeholder="Miasto">
                    </td>
                </tr>
                <tr class="">
                    <td>
                        <label for="street">Ulica</label>
                        <input id="street" type="text" name="street" value="{{ old('street') }}" required placeholder="Ulica">
                    </td>
                </tr>
                <tr class="">
                    <td>
                        <label for="houseNumber">Numer Domu</label>
                        <input id="houseNumber" type="text" pattern="\d+" name="houseNumber" value="{{ old('houseNumber') }}" required>
                    </td>
                </tr>
                <tr class="">
                    <td>
                        <label for="phoneNumber">Numer Telefonu</label>
                        <input id="phoneNumber" type="text" name="phoneNumber" value="{{ old('phoneNumber') }}" required>
                    </td>
                </tr>
                </tbody>
            </table>
            @if($carts->count()!=0)
            <button style="text-align: center; font-size: 2rem;" class="save_order_button">Zamów</button>
            @endif
            @if (session('status'))
                <div class="alert alert-success" style="color: yellow; margin: 20px; padding: 10px; border: solid black 2px" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>
    <script>
        function redirectToProduct(productId) {
            window.location.href = '{{ url("shop/product/") }}' + '/' + productId;
        }
        document.getElementById('postalCode').addEventListener('input', function(event) {
            let inputValue = event.target.value.replace(/[^0-9]/g, '');
            if (inputValue.length > 2) {
                inputValue = inputValue.slice(0, 2) + '-' + inputValue.slice(2);
            }
            if (inputValue.length > 6) {
                inputValue = inputValue.slice(0, 6);
            }
            event.target.value = inputValue;
        });
        document.getElementById('phoneNumber').addEventListener('input', function(event) {
            let inputValue = event.target.value.replace(/[^0-9]/g, '');
            if (inputValue.length > 3 && inputValue.length <= 6) {
                inputValue = inputValue.slice(0, 3) + '-' + inputValue.slice(3);
            }
            if (inputValue.length > 6) {
                inputValue = inputValue.slice(0, 3) + '-' + inputValue.slice(3,6) + '-' + inputValue.substring(6, 9);
            }
            event.target.value = inputValue;
        });
    </script>
@endsection
