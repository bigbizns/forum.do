<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Answering Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .button {
            display: inline-block;
            color: #007bff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #6c757d;
        }

        .text {
            color: #6c757d;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header"><h2>We received your request regarding the following: {{ $topic }}</h2></div>
    <p>{{ $userMessage }}</p>
    <p>{{ $answer }}</p>
</div>
</body>
</html>
