<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket</title>
    <!-- Add any necessary styles for your PDF -->
</head>
<body>
    @foreach($data as $item)
        <h1>Your Ticket</h1>
        <p>Ticket Code: {{ $item['reservation']->ticket_code }}</p>
        <p>Reservation ID: {{ $item['reservation']->reservation_id }}</p>
        <!-- Add other ticket details as needed -->

        <img src="{{ $item['barcode'] }}" alt="Barcode">

        <!-- Add a page break after each ticket -->
        <div style="page-break-after: always;"></div>
    @endforeach
</body>
</html>