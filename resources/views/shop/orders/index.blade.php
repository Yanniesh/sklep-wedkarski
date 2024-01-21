@extends('layouts.app')

@section('content')
    @php
        $totalAmount = 0;
    @endphp
    <div style="width: 60%;">
        <div class="card-header">Zamówienia:</div>
        <table class="Cart-Products-List">
            <thead>
            <tr>
                <th class="CartItem-Atr">Nr</th>
                <th class="CartItem-Atr">Łączny Koszt</th>
                <th class="CartItem-Atr">Status</th>
                <th class="CartItem-Atr">Anuluj Zamówienie</th>
                <th class="CartItem-Atr">Opłać</th>
            </tr>
            </thead>
            <tbody>
            @php
                $var = 0;
            @endphp
            @foreach($orders as $order)
                @php
                    {{$var = $var +1;}}
                @endphp
                <tr>
                    <td class="CartItem-Atr ClickPointer">
                        <a href="{{ route('shop.orders.show', ['id' => $order->id]) }}">
                        {{$var}}
                        </a>
                    </td>
                    <td class="CartItem-Atr">{{ $order->amount}}</td>
                    <td class="CartItem-Atr">{{ $order->paid ? 'Opłacone' : 'Nieopłacone' }}</td>
                    <td class="CartItem-Atr">
                        @if($order->paid)
                            Nie mozna anulować
                        @else
                            <form method="POST" action="{{route('shop.orders.destroy', $order->id)}}">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <button style="text-align: center; font-size: 1rem;" class="save_order_button">
                                    Anuluj Zamówienie
                                </button>
                            </form>
                        @endif

                    </td>
                    <td class="CartItem-Atr">
                        @if($order->paid)
                            Nie mozna oplacic
                        @else
                            <form method="post" action="{{ route('payment.checkout.process', $order->id) }}">
                                @csrf
                                <button style="text-align: center; font-size: 1rem;" class="save_order_button">Opłać</button>
                            </form>
                        @endif

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
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
    </div>
@endsection
