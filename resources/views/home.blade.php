<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    @auth
        <P>SUPER JESTES ZALOGOWANY </P>
        <form action="/logout" method="POST">
            @csrf
            <button> logout </button>
        </form>

        <div style="border: 3px solid black;">
            <h2>Create event</h2>
            <form action="/create-event" method="POST">
                @csrf
                <input name = "title" type='text' placeholder="event title">
                <textarea name = "body" type='text' placeholder="body text"> </textarea>
                <button>Save event</button>
            </form>
        </div>

        <div style="border: 3px solid black;">
            <h2>All events</h2>
            @foreach ($events as $event)
                <div style="background-color: gray; padding: 10px; margin: 10px">
                    <h3> {{ $event['title'] }} </h3>
                    {{ $event['body'] }}
                    <p><a href="/edit-event/{{ $event->id }}">Edit</a></p>
                    <form action="/delete-event/{{ $event->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button>Delete</button>
                    </form>
                </div>
            @endforeach
        </div>
    @else
        <div style="border: 3px solid black;">
            <h2>REGISTER</h2>
            <form action="/register" method="POST">
                @csrf
                <input name = "name" type='text' placeholder="name">
                <input name = "email" type='text' placeholder="email">
                <input name = "password" type='password' placeholder="password">
                <button>Register</button>
            </form>
        </div>

        <div style="border: 3px solid black;">
            <h2>Login</h2>
            <form action="/login" method="POST">
                @csrf
                <input name = "loginname" type='text' placeholder="name">
                <input name = "loginpassword" type='password' placeholder="password">
                <button>Log in</button>
            </form>
        </div>

    @endauth


</body>

</html>
