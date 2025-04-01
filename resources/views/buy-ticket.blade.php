<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Ticket</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h2 class="text-center mb-4">Buy Tickets for {{ $event->title }}</h2>
            <p class="text-muted text-center">Category: <strong>{{ $event->category }}</strong></p>
            <p class="text-muted text-center">Date: <strong>{{ $event->event_date }} - {{ $event->end_date }}</strong></p>
            <p class="text-center"><strong>Available Tickets:</strong> {{ $event->ticket_quantity }}</p>
            
            <form action="/buy-ticket" method="POST">
                @csrf
                <input type="hidden" name="event_id" value="{{ $event->id }}">
                
                @auth
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                    </div>
                @else
                    <div class="form-group">
                        <label for="name">Full Name:</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                    </div>
                @endauth
                
                <div class="form-group">
                    <label for="ticket_quantity">Number of Tickets:</label>
                    <input type="number" id="ticket_quantity" name="ticket_quantity" min="1" max="{{ $event->ticket_quantity }}" value="1" class="form-control" required>
                </div>
                
                <p class="text-center">Total Price: <strong>$<span id="total_price">{{ number_format($event->ticket_price, 2) }}</span></strong></p>
                
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" id="confirmPurchase" {{ $event->ticket_quantity == 0 ? 'disabled' : '' }}>Confirm Purchase</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ticketQuantityInput = document.getElementById("ticket_quantity");
            const totalPriceSpan = document.getElementById("total_price");
            const confirmPurchaseButton = document.getElementById("confirmPurchase");
            const ticketPrice = parseFloat("{{ $event->ticket_price }}") || 0;
            
            function updateTotalPrice() {
                let quantity = parseInt(ticketQuantityInput.value) || 1;
                let totalPrice = quantity * ticketPrice;
                totalPriceSpan.textContent = totalPrice.toFixed(2);
            }
            
            function toggleButtonState() {
                confirmPurchaseButton.disabled = parseInt(ticketQuantityInput.value) <= 0 || {{ $event->ticket_quantity }} == 0;
            }
            
            ticketQuantityInput.addEventListener("input", function() {
                updateTotalPrice();
                toggleButtonState();
            });
            
            updateTotalPrice();
            toggleButtonState();
        });
    </script>
</body>
</html>