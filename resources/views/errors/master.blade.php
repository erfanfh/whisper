<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <link rel="stylesheet" href="{{ asset("css/errors/style.css") }}">
</head>
<body>
<div>
    @yield('code')
    @yield('error')
    @yield('action')
</div>
</body>
</html>
