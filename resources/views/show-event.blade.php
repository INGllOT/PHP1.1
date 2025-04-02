<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szczegóły wydarzenia</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h2>{{ $event->title }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Opis:</strong> {{ $event->description }}</p>
            <p><strong>Miejsce:</strong> {{ $event->place }}</p>
            <p><strong>Data wydarzenia:</strong> {{ \Carbon\Carbon::parse($event->event_date)->format('Y-m-d') }}</p>
            <p><strong>Sprzedaż biletów:</strong> 
                {{ \Carbon\Carbon::parse($event->ticket_start_date)->format('Y-m-d') }} - 
                {{ \Carbon\Carbon::parse($event->ticket_end_date)->format('Y-m-d') }}
            </p>
            <p><strong>Kategoria:</strong> {{ $event->category }}</p>
            <p><strong>Cena biletu:</strong> {{ number_format($event->ticket_price, 2) }} zł</p>

            <p id="ticket_quantity" data-event-id="{{ $event->id }}" class="alert alert-info">
                Dostępne bilety: {{ $event->ticket_quantity }}
            </p>

            <a href="/buy-ticket/{{ $event->id }}" class="btn btn-success">Buy</a>
            <a href="/" class="btn btn-secondary">Home</a>
        </div>
    </div>
</div>

<script>
    function updateTicketQuantity() {
        var eventId = $('#ticket_quantity').data('event-id');

        $.ajax({
            url: '/get-ticket-quantity/' + eventId, 
            type: 'GET',
            success: function(response) {
                $('#ticket_quantity').text('Dostępne bilety: ' + response.ticket_quantity);
            },
            error: function(error) {
                console.error("Błąd pobierania liczby biletów", error);
            }
        });
    }

    // Aktualizacja co 5 sekund
    setInterval(updateTicketQuantity, 5000);
</script>

</body>
</html>
