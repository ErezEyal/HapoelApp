<html>
<head>
    <title>ACAB</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="m-0 overflow-y-scroll overflow-x-hidden" style="background: #F2F2F2; font-family: arial,sans-serif;">
    <div class="w-screen">
            <div style="height: 55px; background: #FB4242">

            </div>
            <div style="background: #FB4242" class="shadow-md">
                <div class="grid grid-cols-5 mb-4 mx-auto" name="nav-bar" style="width: 752px; background: #FB4242">
                    <div name="Fixures" style="height: 46px" class="hover:bg-red-600 {{ Request::is('matches') ? 'border-solid border-white border-2 border-t-0 border-l-0 border-r-0' : '' }} ">
                        <a href="#" class="block h-full text-center py-4 text-xs no-underline" style="color: {{ Request::is('matches') ? 'white' : '#d2dae7' }}">MATCHES</a>
                    </div>
                    <div name="News" style="height: 46px" class="hover:bg-red-600 {{ Request::is('news') ? 'border-solid border-white border-2 border-t-0 border-l-0 border-r-0' : '' }} ">
                        <a href="/news" class="block h-full text-center py-4 text-xs no-underline" style="color: {{ Request::is('news') ? 'white' : '#d2dae7' }}">NEWS</a>
                    </div>
                    <div name="table" style="height: 46px" class="hover:bg-red-600 {{ Request::is('table') ? 'border-solid border-white border-2 border-t-0 border-l-0 border-r-0' : '' }} ">
                        <a href="/table" class="block h-full text-center py-4 text-xs no-underline" style="color: {{ Request::is('table') ? 'white' : '#d2dae7' }}">STANDINGS</a>
                    </div>
                    <div name="stats" style="height: 46px" class="hover:bg-red-600 {{ Request::is('stats') ? 'border-solid border-white border-2 border-t-0 border-l-0 border-r-0' : '' }} ">
                        <a href="#" class="block h-full text-center py-4 text-xs no-underline" style="color: {{ Request::is('stats') ? 'white' : '#d2dae7' }}">STATS</a>
                    </div>
                    <div name="players" style="height: 46px" class="hover:bg-red-600 {{ Request::is('players') ? 'border-solid border-white border-2 border-t-0 border-l-0 border-r-0' : '' }} ">
                        <a href="#" class="block h-full text-center py-4 text-xs no-underline" style="color: {{ Request::is('matches') ? 'white' : '#d2dae7' }}">PLAYERS</a>
                    </div>
                </div>
            </div>
        @yield('main')
</body>
</html>
