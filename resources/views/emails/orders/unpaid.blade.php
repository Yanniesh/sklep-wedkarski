<!-- resources/views/emails/orders/unpaid.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zamówienie</title>
</head>
<body>

<h1>Status zamówienia uległ zmianie.</h1>

<p>Zamówione produkty:</p>

@foreach ($Carts as $item)
    @if (is_array($item))
        <p>- {{ $item['product'] }} (ilość: {{ $item['quantity'] }}, cena: {{ $item['price'] }} PLN)</p>
    @else
        <p>Wartość łącznie: {{ $item }} PLN</p>
    @endif
@endforeach

<p>Dziękujemy za skorzystanie z usługi,<br>{{ config('app.name') }} Team</p>

</body>
</html>
