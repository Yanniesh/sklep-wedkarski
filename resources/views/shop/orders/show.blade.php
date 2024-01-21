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
                            <div style="align-self: center; padding: 8px;">
                                {{ $cart->quantity }}
                            </div>
                        </div>
                    </td>
                    <td class="CartItem-Atr">{{ $cart->amount }}</td>
                </tr>
                @php
                    $totalAmount += $cart->amount;
                @endphp
            @endforeach
            </tbody>
        </table>
        Do zapłaty: {{ $totalAmount }}
    </div>
    <script>
        function redirectToProduct(productId) {
            window.location.href = '{{ url("shop/product/") }}' + '/' + productId;
        }
    </script>
@endsection
