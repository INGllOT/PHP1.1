<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    @auth
        <P>Logged in !!!</P>
        <form action="/logout" method="POST">
            @csrf
            <button> logout </button>
        </form>

        <form action="/change-password" method="POST">
            @csrf
            @method('PUT')
            <input name = "new_password" type='password' placeholder="enter new password">
            <button>Change password</button>
        </form>


        <div style="border: 3px solid black;">
            <h2>Create event</h2>
            <form action="/create-event" method="POST">
                @csrf
                <input name = "title" type='text' placeholder="event title">
                <label>Body text</label>
                <textarea name = "body" type='text' placeholder="body text"> </textarea>
                <input name="start_date" type="date" placeholder="Start Date">
                <input name="end_date" type="date" placeholder="End Date">

                <label>Category</label>
                <select name="category">
                    @foreach ($categories as $category)
                        <option value="{{ $category }}">{{ $category }}</option>
                    @endforeach
                </select>

                <button>Save event</button>
            </form>
        </div>

        <div style="border: 3px solid black;">
            <h2>All events</h2>
            @foreach ($events as $event)
                <div
                    style="background-color: 
            {{ $event['category'] === 'History' ? 'lightblue' : ($event['category'] === 'Science' ? 'lightgreen' : ($event['category'] === 'Sport' ? 'lightcoral' : 'gray')) }}; 
            padding: 10px; margin: 10px">

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

        <div style="border: 3px solid black;">
            <h2>All events</h2>
            @foreach ($events as $event)
                <div
                    style="background-color: 
            {{ $event['category'] === 'History' ? 'lightblue' : ($event['category'] === 'Science' ? 'lightgreen' : ($event['category'] === 'Sport' ? 'lightcoral' : 'gray')) }}; 
            padding: 10px; margin: 10px">

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

                </div>
            @endforeach
        </div>

    @endauth


</body>

</html>
