<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Event Details</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">

    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Title: {{ $event['title'] }}</h3>
            <h5 class="card-subtitle mb-2 text-muted">Category: {{ $event['category'] }}</h5>
            <h6 class="card-text">
                <small>{{ $event['event_date'] }} - {{ $event['end_date'] }}</small>
            </h6>
            <p class="card-text">{{ $event['body'] }}</p>

            <!-- Przycisk otwierający modal -->
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#buyTicketModal">
                Buy Ticket
            </button>
        </div>
    </div>

    <form action="/" method="GET" class="mt-4">
        <button type="submit" class="btn btn-secondary">Home</button>
    </form>

    @auth
    <!-- Modal do kupowania biletów -->
    <div class="modal fade" id="buyTicketModal" tabindex="-1" aria-labelledby="buyTicketModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="buyTicketModalLabel">Buy Tickets</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/buy-ticket" method="POST">
                        @csrf
                        <input type="hidden" name="event_id" value="{{ $event->id }}">

                        <div class="form-group">
                            <label for="ticket_quantity">Number of tickets:</label>
                            <input type="number" name="ticket_quantity" min="1" max="{{ $event->ticket_quantity }}" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Confirm Purchase</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @else
     <!-- Modal do kupowania biletów -->
     <div class="modal fade" id="buyTicketModal" tabindex="-1" aria-labelledby="buyTicketModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="buyTicketModalLabel">Buy Tickets</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/buy-ticket" method="POST">
                        @csrf
                        <input type="hidden" name="event_id" value="{{ $event->id }}">

                        <div class="form-group">
                            <label for="ticket_quantity">Number of tickets:</label>
                            <input type="number" name="ticket_quantity" min="1" max="{{ $event->ticket_quantity }}" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Confirm Purchase</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endauth


    <!-- Skrypty Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
