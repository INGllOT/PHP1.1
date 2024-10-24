<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Event</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">
    @auth
        <h1 class="mb-4">Edit Event</h1>
        <form action="/edit-event/{{ $event->id }}" method="POST" class="needs-validation">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" value="{{ $event->title }}" class="form-control" id="title" required>
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea name="body" class="form-control" id="body" rows="5" required>{{ $event->body }}</textarea>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" class="form-control">
                    @foreach ($categories as $category)
                        <option value="{{ $category }}">{{ $category }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    @else
        <h1>You are not logged in</h1>
        <form action="/" method="GET">
            <button class="btn btn-secondary">Home</button>
        </form>
    @endauth

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
