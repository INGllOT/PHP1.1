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
                <small>{{ $event['start_date'] }} - {{ $event['end_date'] }}</small>
            </h6>
            <p class="card-text">{{ $event['body'] }}</p>
        </div>
    </div>

    <form action="/" method="GET" class="mt-4">
        <button type="submit" class="btn btn-secondary">Home</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
