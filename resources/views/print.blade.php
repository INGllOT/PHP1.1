<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print events</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        @media print {
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 20px;
                background-color: #ffffff;
            }

            .print-button {
                display: none;
            }
        }
    </style>
</head>

<div class="card">
    <div class="card-body">
        <button onclick="window.print()" class="btn btn-info print-button">Print</button>
    </div>
</div>

<body>
    <h1>Events </h1>
    @foreach ($events as $event)
        <div class="card mb-3"
            style="background-color: 
                        {{ $event['category'] === 'History' ? 'lightblue' : ($event['category'] === 'Science' ? 'lightgreen' : ($event['category'] === 'Sport' ? 'lightcoral' : 'gray')) }};">
            <div class="card-body, .no-print">
                <h3 class="card-title">Title: {{ $event['title'] }}</h3>
                <h4 class="card-subtitle mb-2 text-muted">Category: {{ $event['category'] }}</h4>
                <h5 class="card-text"><small>{{ $event['event_date'] }} - {{ $event['end_date'] }}</small>
                </h5>
                <p class="card-text">{{ $event['body'] }}</p>
            </div>
        </div>
    @endforeach

</body>

</html>
