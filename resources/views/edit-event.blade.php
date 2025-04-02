<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>

<div class="container mt-5">
    @if(auth()->check() && auth()->user()->role === 'admin')
    <div class="card">
            <div class="card-body">
                <h2 class="card-title">Edit Event</h2>
                <form action="/edit-event/{{ $event->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input name="title" type="text" class="form-control" value="{{ $event->title }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" required>{{ $event->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="place">Event Place</label>
                        <input name="place" type="text" class="form-control" value="{{ $event->place }}" required>
                    </div>
                    <div class="form-group">
                        <label for="ticket_price">Ticket Price </label>
                        <input name="ticket_price" type="number" step="0.01" class="form-control" value="{{ $event->ticket_price }}" required>
                    </div>
                    <div class="form-group">
                        <label for="ticket_quantity">Ticket Quantity</label>
                        <input name="ticket_quantity" type="number" class="form-control" value="{{ $event->ticket_quantity }}" required>
                    </div>
                    <div class="form-group">
                        <label for="event_date">Event Date</label>
                        <input name="event_date" type="date" class="form-control" value="{{ \Carbon\Carbon::parse($event['event_date'])->format('Y-m-d') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="ticket_start_date">Ticket Sale Start</label>
                        <input name="ticket_start_date" type="date" class="form-control" value="{{ \Carbon\Carbon::parse($event['ticket_start_date'])->format('Y-m-d') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="ticket_end_date">Ticket Sale End</label>
                        <input name="ticket_end_date" type="date" class="form-control" value="{{ \Carbon\Carbon::parse($event['ticket_end_date'])->format('Y-m-d') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category" class="form-control" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category['category'] }}" {{ $event->category == $category['category'] ? 'selected' : '' }}>
                                    {{ $category['category'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                    <a href="/" class="btn btn-secondary">Home</a>
                </form>
            </div>
        </div>
    @else
        <div class="alert alert-danger">You do not have permission to edit events.</div>
    @endif
</div>
</body>
</html>