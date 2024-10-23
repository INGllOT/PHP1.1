<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @auth
        <h1>Edit event</h1>
        <form action="/edit-event/{{ $event->id }}" method="POST">
            @csrf
            @method('PUT')
            <input type="text" name="title" value="{{ $event->title }}">
            <textarea name="body">{{ $event->body }}</textarea>
            <button>Save Changes</button>
        </form>
    @else
        <h1>You are not logged in</h1>

        <form action="/" method="GET">
            <button> home </button>
        </form>

    @endauth
</body>

</html>
