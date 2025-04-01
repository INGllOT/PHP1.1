<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Tickets</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Your Purchased Tickets</h2>
    @if($tickets->isEmpty())
        <p>You have not purchased any tickets yet.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Event Title</th>
                    <th>Ticket Quantity</th>
                    <th>Price per Ticket</th>
                    <th>Total Price</th>
                    <th>Event Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->event_description }}</td>
                        <td>{{ $ticket->ticket_quantity }}</td>
                        <td>{{ number_format($ticket->ticket_price, 2) }} zł</td>
                        <td>{{ number_format($ticket->ticket_quantity * $ticket->ticket_price, 2) }} zł</td>
                        <td>{{ \Carbon\Carbon::parse($ticket->event_date)->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>
