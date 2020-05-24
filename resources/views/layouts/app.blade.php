<html lang="es">
<head>
    <title>TBK - @yield('title')</title>
    <link rel="stylesheet" href="https://unpkg.com/sakura.css/css/sakura.css" type="text/css">
</head>
<body>
<div class="container">
    <h1>@yield('title')</h1>
    <div>
        @yield('breadcrumbs')
    </div>
    <br>
    <div>
        @yield('content')
    </div>
</div>
</body>
</html>
