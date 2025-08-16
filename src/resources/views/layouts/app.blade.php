<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PiGLy</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    @yield('css')
</head>
<body>
    <div class="initial_weight-form__inner">
    <header class="header">
    <h1 class="header__heading">PiGLy</h1>
        @yield('link')
    </header>
    <div class="content">
        @yield('content')
</body>
</html>