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
                    <input type="hidden" name="event_id" value="{{ $event -> id }}">

                    <!-- Jeśli użytkownik jest zalogowany, wypełniamy dane automatycznie -->
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
                        {{-- {{-- <!-- Jeśli użytkownik nie jest zalogowany, zachęta do rejestracji -->
                        <p class="text-danger">You are not log in.</p>
                        <p class="text-danger">Enter your data or log in.</p>
                        <p class="text-danger">Dont have a account ? Register now.</p> --}}

                        <div class="form-group">
                            <label for="name">Full Name:</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                        </div> 
                    @endauth

                    <!-- Wybór liczby biletów -->
                    <div class="form-group">
                        <label for="ticket_quantity">Number of tickets:</label>
                        <input type="number" id="ticket_quantity" name="ticket_quantity" min="1" max="{{ $event->ticket_quantity }}" value="1" class="form-control" required>
                    </div>

                    <!-- Wyświetlanie sumarycznej ceny -->
                    {{-- <p>Total Price: <strong>$<span id="total_price">{{ $event->price }}</span></strong></p> --}}

                    <button type="submit" class="btn btn-primary">Confirm Purchase</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        const ticketQuantityInput = document.getElementById("ticket_quantity");
        const totalPriceSpan = document.getElementById("total_price");
        const ticketPrice = parseFloat({{ $event->ticket_price }});
    
        ticketQuantityInput.addEventListener("input", function() {
            let quantity = parseInt(ticketQuantityInput.value) || 1;
            let totalPrice = quantity * ticketPrice;
            totalPriceSpan.textContent = totalPrice.toFixed(2);
        });
    });
    </script>
     --}}
