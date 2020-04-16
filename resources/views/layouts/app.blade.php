<html>
<head>
    <title>ACAB</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="m-0 overflow-y-scroll overflow-x-hidden bg-gray-100 bg-no-repeat bg-cover bg-center bg-fixed" style="backkkkkground-image: url('bg.jpg'); font-family: arial,sans-serif;">
    <div class="w-screen top-0 fixed">
            <div style="background: #C70101" class="shadow-md">
                <div class="grid grid-cols-9 mb-4 mx-auto h-16" name="nav-bar" style="width: 752px; background: #C70101">
                    <div name="image">
                        <img src="https://media.api-sports.io/teams/4501.png" class="w-12 ml-3 mt-2">
                    </div>

                    <a href="/home" class="col-span-2 text-center font-bold text-sm no-underline hover:text-white {{ Request::is('home') ? 'text-white' : 'text-gray-400' }}">
                        <div name="home"  class="tracking-wider">
                            <span style="line-height:62px;">HOME</span>
                        </div>
                    </a>

                    <a href="/matches" class="col-span-2 text-center font-bold text-sm no-underline hover:text-white {{ Request::is('matches') ? 'text-white' : 'text-gray-400' }}">
                        <div name="Matches"  class="tracking-wider">
                            <span style="line-height:62px;">MATCHES</span>
                    </div>
                    </a>

                    <a href="/news" class="col-span-2 text-center font-bold text-sm no-underline hover:text-white {{ Request::is('news') ? 'text-white' : 'text-gray-400' }}">
                        <div name="News"  class="tracking-wider">
                            <span style="line-height:62px;">NEWS</span>
                        </div>
                    </a>

                    <a href="/standings" class="col-span-2 text-center font-bold text-sm no-underline hover:text-white {{ Request::is('standings') ? 'text-white' : 'text-gray-400' }}">
                        <div name="table"  class="tracking-wider">
                            <span style="line-height:62px;">STANDINGS</span>
                        </div>
                    </a>


                </div>
            </div>
    </div>
    <div name="main" class="mt-20">
        @yield('main')
    </div>
</body>
</html>
