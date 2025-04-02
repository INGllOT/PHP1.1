<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Event Management</title>

    <link href="{{ asset('/app.css') }}" rel="stylesheet" type="text/css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="container mt-5">

    @auth
        <div class="container">

            <div class="col-md-6">
                <p class="alert alert-success">Witaj, {{ auth()->user()->name }}!</p>
                <form action="/change-password" method="POST" class="mb-4">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <input name="new_password" type="password" class="form-control" placeholder="Enter new password">
                    </div>
                    <button type="submit" class="btn btn-primary">Change password</button>
                </form>

                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger mb-3">Logout</button>
                </form>
            </div>
            <div class="row">

                @if (auth()->check() && auth()->user()->role === 'admin')
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h2 class="card-title">Create Event</h2>
                                <form action="/create-event" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input name="title" type="text" class="form-control" placeholder="Event title"
                                            value="Default">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <input name="description" type="text" class="form-control"
                                            placeholder="Description" value="Default"></input>
                                    </div>
                                    <div class="form-group">
                                        <label for="place">Event place</label>
                                        <input name="place" class="form-control" placeholder="Event place"
                                            value="Default"></input>
                                    </div>
                                    <div class="form-group">
                                        <label for="ticket_price">Ticket price</label>
                                        <input name="ticket_price" class="form-control" placeholder="Ticket price"
                                            value=1></input>
                                    </div>
                                    <div class="form-group">
                                        <label for="ticket_quantity">Ticket quantity</label>
                                        <input name="ticket_quantity" class="form-control" placeholder="Ticket quantity"
                                            value=1></input>
                                    </div>
                                    <div class="form-group">
                                        <label for="event_date">Event date</label>
                                        <input name="event_date" type="date" class="form-control" value="2021-01-01">
                                    </div>
                                    <div class="form-group">
                                        <label for="ticket_start_date">Ticket sale start</label>
                                        <input name="ticket_start_date" type="date" class="form-control"
                                            value="2021-01-01">
                                    </div>
                                    <div class="form-group">
                                        <label for="ticket_end_date">Ticket sale end</label>
                                        <input name="ticket_end_date" type="date" class="form-control"
                                            value="2021-01-01">
                                    </div>
                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <select name="category" class="form-control">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category['category'] }}">{{ $category['category'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-success">Save event</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif

                @if (auth()->check() && auth()->user()->role === 'admin')
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h2 class="card-title">Edit categories </h2>

                                <form action="/save-category" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input name="category" type="text" class="form-control"
                                            placeholder="Add category">
                                    </div>

                                    <button type="submit" class="btn btn-success">Save</button>
                                </form>

                                @foreach ($categories as $category)
                                    <form action="/delete-category/{{ $category->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="form-group">
                                            <h4>{{ $category['category'] }}</h4>
                                        </div>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                @endforeach

                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
        <a href="/user-tickets" class="btn btn-info">Show my tickets</a>


        <div class="timeline">
            @foreach ($events as $event)
                <div class="timeline-item">
                    <div class="timeline-icon" style="background-color:  {{ $event['color'] }};"></div>
                    <div class="timeline-content">
                        <h3 class="timeline-title">Title: {{ $event['title'] }}</h3>
                        <h4 class="timeline-category">Category: {{ $event['category'] }}</h4>

                        <!-- Dodanie daty wydarzenia -->
                        <h3 class="timeline-date">
                            Event date: {{ \Carbon\Carbon::parse($event['event_date'])->format('Y-m-d') }}
                        </h3>

                        <!-- Dodanie dat sprzedaży biletów -->
                        <h6 class="timeline-ticket-date">
                            Tickets sale:
                            {{ \Carbon\Carbon::parse($event['ticket_start_date'])->format('Y-m-d') }} -
                            {{ \Carbon\Carbon::parse($event['ticket_end_date'])->format('Y-m-d') }}
                        </h6>

                        <!-- Dodanie liczby dostępnych biletów -->
                        <p class="timeline-body">{{ $event['body'] }}</p>
                        <p id="ticket_quantity" data-event-id="{{ $event->id }}" class="timeline-tickets"
                            aria-live="polite">
                            Available tickets: {{ $event['ticket_quantity'] }}
                        </p>

                        <!-- Dodanie ceny biletu -->
                        <p class="timeline-price">
                            Ticket price: {{ number_format($event['ticket_price'], 2) }} zł
                        </p>

                        <div class="timeline-actions">

                            <a href="/show-event/{{ $event->id }}" class="btn btn-info">Show</a>
                            @if ($event['ticket_quantity'] > 0)
                                <a href="/buy-ticket/{{ $event->id }}" class="btn btn-success">Buy</a>
                            @else
                                <span class="text-danger" role="alert">Brak dostępnych biletów</span>
                            @endif
                            @if (auth()->check() && auth()->user()->role === 'admin')
                                <a href="/edit-event/{{ $event->id }}" class="btn btn-warning">Edit</a>
                                <form action="/delete-event/{{ $event->id }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title">Register</h2>
                        <form action="/register" method="POST">
                            @csrf
                            <div class="form-group">
                                <input name="name" type="text" class="form-control" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <input name="email" type="text" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input name="password" type="password" class="form-control" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-primary">Register</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title">Login</h2>
                        <form action="/login" method="POST">
                            @csrf
                            <div class="form-group">
                                <input name="loginname" type="text" class="form-control" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <input name="loginpassword" type="password" class="form-control" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-primary">Log in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="timeline">
            @foreach ($events as $event)
                <div class="timeline-item">
                    <div class="timeline-icon"
                        style="background-color: 
                        {{ $event['category'] === 'History' ? 'lightblue' : ($event['category'] === 'Science' ? 'lightgreen' : ($event['category'] === 'Sport' ? 'lightcoral' : 'gray')) }};">
                    </div>
                    <div class="timeline-content">
                        <h3 class="timeline-title">Title: {{ $event['title'] }}</h3>
                        <h4 class="timeline-category">Category: {{ $event['category'] }}</h4>

                        <!-- Dodanie daty wydarzenia -->
                        <h3 class="timeline-date">
                            Event date: {{ \Carbon\Carbon::parse($event['event_date'])->format('Y-m-d') }}
                        </h3>

                        <!-- Dodanie dat sprzedaży biletów -->
                        <h6 class="timeline-ticket-date">
                            Tickets sale:
                            {{ \Carbon\Carbon::parse($event['ticket_start_date'])->format('Y-m-d') }} -
                            {{ \Carbon\Carbon::parse($event['ticket_end_date'])->format('Y-m-d') }}
                        </h6>

                        <!-- Dodanie liczby dostępnych biletów -->
                        <p class="timeline-body">{{ $event['body'] }}</p>
                        <p id="ticket_quantity" data-event-id="{{ $event->id }}" class="timeline-tickets"
                            aria-live="polite">
                            Available tickets: {{ $event['ticket_quantity'] }}
                        </p>

                        <!-- Dodanie ceny biletu -->
                        <p class="timeline-price"> Ticket price: {{ number_format($event['ticket_price'], 2) }} zł </p>
                        <div class="timeline-actions">
                            <a href="/show-event/{{ $event->id }}" class="btn btn-info">Show</a>
                            @if ($event['ticket_quantity'] > 0)
                                <a href="/buy-ticket/{{ $event->id }}" class="btn btn-success">Buy</a>
                            @else
                                <span class="text-danger" role="alert">Brak dostępnych biletów</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endauth


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        function updateTicketQuantities() {
            $('.timeline-tickets').each(function() { 
                var eventId = $(this).data('event-id'); 
                var ticketElement = $(this); 
                $.ajax({
                    url: '/get-ticket-quantity/' + eventId,
                    type: 'GET',
                    success: function(response) {
                        ticketElement.text('Available tickets: ' + response.ticket_quantity);
                    },
                    error: function(error) {
                        console.error("Błąd podczas pobierania liczby biletów", error);
                    }
                });
            });
        }

        // Uruchamianie co 5 sekund (można zmienić na inną wartość)
        setInterval(updateTicketQuantities, 5000);
    </script>

</body>

</html>
