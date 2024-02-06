@extends('layouts.app')

@section('content')
    <script src="https://js.stripe.com/v3/"></script>

    <button id="checkout-button">Zapłać teraz</button>

    <form method="post" action="{{ route('payment.checkout.process') }}">
        @csrf
        <button type="submit">Zapłać</button>
    </form>

@endsection
