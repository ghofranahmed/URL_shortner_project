<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickLink - URL Shortener</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            background: #ffffff;
            padding: 30px 35px;
            border-radius: 12px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            text-align: center;
        }

        .container h1 {
            margin-bottom: 10px;
            color: #333;
        }

        .container p {
            color: #666;
            font-size: 14px;
            margin-bottom: 25px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input[type="url"] {
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
            outline: none;
            transition: border 0.3s;
        }

        input[type="url"]:focus {
            border-color: #667eea;
        }

        button {
            padding: 12px;
            border: none;
            border-radius: 8px;
            background-color: #667eea;
            color: white;
            font-size: 15px;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background-color: #5563c1;
        }

        .errors {
            background: #ffe6e6;
            color: #cc0000;
            padding: 10px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 15px;
            text-align: left;
        }

        footer {
            margin-top: 20px;
            font-size: 12px;
            color: #aaa;
        }
    </style>
</head>

<body>

<div class="container">
    <h1>QuickLink</h1>
    <p>Paste your long URL below and get a short, shareable link.</p>

    @if ($errors->any())
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/api/shorten') }}" method="POST">
        @csrf
        <input type="url" name="url" placeholder="https://example.com" required>
        <button type="submit">Shorten URL</button>
    </form>

    <footer>
        © {{ date('Y') }} QuickLink | URL Shortener
    </footer>
</div>

</body>
</html>
