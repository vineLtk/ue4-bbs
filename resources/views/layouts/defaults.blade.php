<!DOCTYPE HTML>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSRF TOKEN -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', (isset($title)?$title:''))-UE4小论坛</title>
    <meta name="description" content="@yield('description', 'UE4爱好者社区')" />

    <!-- styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @yield('styles')
</head>

<body>
    <div id="app" class="{{ route_class()}}-page">

        <!-- 公用头部 -->
        @include('layouts._header')
       
        <!-- 内容 -->
        <div class="container">
            @include('layouts._messages')
            @yield('content')
        </div>

        <!-- 公用底部 -->
        @include('layouts._footer')
    </div>

    <!-- JS引入 -->
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('scripts')
</body>

</html>