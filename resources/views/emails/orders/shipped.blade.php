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

<p>Zamówienie zostało wysłane na adres:</p>
    {{ $orderAddress->name }} {{ $orderAddress->surname }},<br>
    {{ $orderAddress->postal_code}},{{ $orderAddress->city}},<br>
    {{ $orderAddress->street }} {{ $orderAddress->house_number }},<br>
    {{ $orderAddress->phone_number}},<br>
<p>Dziękujemy za skorzystanie z usługi,<br>{{ config('app.name') }} Team</p>

</body>
</html>

