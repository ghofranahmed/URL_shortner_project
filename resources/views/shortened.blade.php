<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickLink - Shortened URL</title>
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

        .short-url {
            background: #f0f4ff;
            padding: 12px;
            border-radius: 8px;
            font-size: 14px;
            color: #333;
            word-break: break-all;
        }

        a {
            color: #667eea;
            text-decoration: none;
            font-weight: bold;
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
    <h1>Shortened Successfully!</h1>
    <p>Your short link is ready:</p>
    <div class="short-url">
        <a href="{{ $shortUrl }}" target="_blank">{{ $shortUrl }}</a>
    </div>
    <footer>
        © {{ date('Y') }} QuickLink | URL Shortener
    </footer>
</div>
</body>
</html>
