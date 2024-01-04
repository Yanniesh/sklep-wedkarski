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
                @foreach($products as $product)
                    <tr>
                        <td class="CartItem-Atr ClickPointer" onclick="redirectToProduct({{ $product->id }})">{{ $product->product->name }}</td>
                        <td class="CartItem-Atr">{{ $product->product->price }}</td>
                        <td class="CartItem-Atr">{{ $product->quantity }}</td>
                        <td class="CartItem-Atr">{{ $product->amount }}</td>
                        <td class="CartItem-Atr">
                            <form  method="POST" action="{{route('cart.destroy', $product->id)}}">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <button style="text-align: center; font-size: 2rem;" class="CategoryDeleteButton">X</button>
                            </form>

                        </td>
                    </tr>
                    @php
                        $totalAmount += $product->amount;
                    @endphp
                @endforeach
                </tbody>
            </table>
        Do zapłaty: {{ $totalAmount }}
        <form  class="OrderForm" method="GET" action="">
            {{csrf_field()}}
            <table class="OrderForm">
                <tbody class="OrderFormBody">
                    <tr >
                        <td>
                            <label for="name">Imię</label>
                            <input type="text" id="name" name="name" required placeholder="Imię">
                        </td>
                    </tr>
                    <tr class="Label-Input">
                        <td>
                            <label for="surname">Nazwisko</label>
                            <input type="text"  name="surname" required placeholder="Nazwisko">
                        </td>

                    </tr>
                    <tr class="">
                        <td>
                            <label for="City">Miasto</label>
                            <input type="text"  name="City" required placeholder="Miasto">
                        </td>

                    </tr>
                    <tr class="">
                        <td>
                            <label for="Street">Ulica</label>
                            <input type="text"  name="Street" required placeholder="Ulica">
                        </td>

                    </tr>
                    <tr class="">
                        <td>
                            <label for="PostalCode">Kod Pocztowy</label>
                            <input type="text"  name="PostalCode" required placeholder="Kod Pocztowy">
                        </td>

                    </tr>
                </tbody>
            </table>




            <button style="text-align: center; font-size: 2rem;" class="save_order_button">Zamów</button>
        </form>
    </div>
    <script>
        function redirectToProduct(productId) {
            window.location.href = '{{ url("shop/product/") }}' + '/' + productId;
        }
    </script>
@endsection
