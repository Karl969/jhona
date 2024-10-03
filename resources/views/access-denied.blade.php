<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied</title>
</head>
<body>
    <h1>Access Denied</h1>
    <p>You must be at least 18 years old to order.</p>
    <a href="{{ route('ageverification') }}">
        <button>Verify Age Again</button>
    </a>
</body>
</html>
