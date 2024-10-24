<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Event Management</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">

    @auth
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title">Create Event</h2>
                        <form action="/create-event" method="POST">
                            @csrf
                            <div class="form-group">
                                <input name="title" type="text" class="form-control" placeholder="Event title">
                            </div>
                            <div class="form-group">
                                <label for="body">Body text</label>
                                <textarea name="body" class="form-control" placeholder="Body text"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input name="start_date" type="date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input name="end_date" type="date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="category" class="form-control">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category }}">{{ $category }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Save event</button>
                        </form>
                    </div>
                </div>
            </div>
    
            <div class="col-md-6">
                <p class="alert alert-success">Logged in !!!</p>
    
                
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
        </div>
    </div>
    

    <div class="card">
        <div class="card-body">
            <h2 class="card-title">All Events</h2>
            @foreach ($events as $event)
                <div class="card mb-3"
                    style="background-color: 
                        {{ $event['category'] === 'History' ? 'lightblue' : ($event['category'] === 'Science' ? 'lightgreen' : ($event['category'] === 'Sport' ? 'lightcoral' : 'gray')) }};">
                    <div class="card-body">
                        <h3 class="card-title">Title: {{ $event['title'] }}</h3>
                        <h4 class="card-subtitle mb-2 text-muted">Category: {{ $event['category'] }}</h4>
                        <h5 class="card-text"><small>{{ $event['start_date'] }} - {{ $event['end_date'] }}</small></h5>
                        <p class="card-text">{{ $event['body'] }}</p>
    
                        <div class="d-flex">
                            <a href="/edit-event/{{ $event->id }}" class="btn btn-warning" style="margin-right: 10px;">Edit</a>
                            <a href="/show-event/{{ $event->id }}" class="btn btn-info" style="margin-right: 10px;">Show</a>
                            <form action="/delete-event/{{ $event->id }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                        
                        
    
                    </div>
                </div>
            @endforeach
        </div>
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


        <div class="card">
            <div class="card-body">
                <h2 class="card-title">All Events</h2>
                @foreach ($events as $event)
                    <div class="card mb-3"
                        style="background-color: 
                        {{ $event['category'] === 'History' ? 'lightblue' : ($event['category'] === 'Science' ? 'lightgreen' : ($event['category'] === 'Sport' ? 'lightcoral' : 'gray')) }};">
                        <div class="card-body">
                            <h3 class="card-title">Title: {{ $event['title'] }}</h3>
                            <h4 class="card-subtitle mb-2 text-muted">Category: {{ $event['category'] }}</h4>
                            <h5 class="card-text"><small>{{ $event['start_date'] }} - {{ $event['end_date'] }}</small>
                            </h5>
                            <p class="card-text">{{ $event['body'] }}</p>
                            <p><a href="/show-event/{{ $event->id }}" class="btn btn-info">Show</a></p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    @endauth

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
