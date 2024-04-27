<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  
</head>
<body>
     <header>
        <nav class="menu_nav">
            <ul class="menu">
                <li><a href="{{ route('country') }}">Country</a></li>
                <li><a href="{{ route('persons') }}">Person</a></li>
                <li><a href="{{ route('users') }}">User</a></li>
                <li><a href="{{ route('companies') }}">Company</a></li>
                <li><a href="{{ route('roles') }}">Roles</a></li>
                <li><a href="{{ route('projects') }}">Project</a></li>
                <li><a href="{{ route('tasks') }}">Task</a></li>
            </ul>
        </nav>
    </header>
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
