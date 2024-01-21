@extends('layouts.app')

@section('content')
    <script src="https://js.stripe.com/v3/"></script>

    <button id="checkout-button">Zapłać teraz</button>

    <form method="post" action="{{ route('payment.checkout.process') }}">
        @csrf
        <button type="submit">Zapłać</button>
    </form>

    <script>
        {{--var stripe = Stripe('{{ config('services.stripe.key') }}');--}}

        {{--var checkoutButton = document.getElementById('checkout-button');--}}

        {{--checkoutButton.addEventListener('click', function () {--}}
        {{--    stripe.redirectToCheckout({--}}
        {{--        lineItems: [{--}}
        {{--            price: 'price_1Ob69CJfHHyr0WA3OuNwZS9N',--}}
        {{--            quantity: 1,--}}
        {{--        }],--}}
        {{--        mode: 'payment',--}}
        {{--        successUrl: window.location.origin + '/success',--}}
        {{--        cancelUrl: window.location.origin + '/cancel',--}}
        {{--        payment_method_types: ['card'],--}}
        {{--        payment_method: {--}}
        {{--            card: {--}}
        {{--                number: '4242424242424242',--}}
        {{--                exp_month: 12,--}}
        {{--                exp_year: 24,--}}
        {{--                cvc: '123',--}}
        {{--            }--}}
        {{--        },--}}
        {{--    })--}}
        {{--        .then(function (result) {--}}
        {{--            if (result.error) {--}}
        {{--                console.error(result.error);--}}
        {{--                alert(result.error.message);--}}
        {{--            }--}}
        {{--        });--}}
        {{--});--}}
    </script>
@endsection
