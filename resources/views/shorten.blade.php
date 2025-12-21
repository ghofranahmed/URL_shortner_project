<!-- resources/views/shorten.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickLink-URL shortener</title>
  
</head>
<body>
    <h1>Welcome to QuickLink </h1>
    
   <h3> please enter a valid url
   </h3>
   @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ url('/api/shorten') }}" method="POST">
        @csrf
        <label for="url">Enter URL:</label>
        <input type="url" name="url" required>
        <button type="submit">Shorten</button>
    </form>

</body>
</html>
