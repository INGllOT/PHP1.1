<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h3>
        Title: {{ $event['title'] }}
    </h3>
    <h4>
        Category: {{ $event['category'] }}
    </h4>
    <h4>
        <small> {{ $event['start_date'] }} : {{ $event['end_date'] }}</small>
    </h4>

    {{ $event['body'] }}

    <form action="/" method="GET">
        <button action="/"> home </button>
    </form>

</body>
</html>