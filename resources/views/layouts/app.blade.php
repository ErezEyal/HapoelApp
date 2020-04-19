<html>
<head>
    <title>ACAB</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .section {
            display: none;
        }
        #dashboard {
            display: block;
        }
    </style>
</head>
<body class="m-0 overflow-y-scroll overflow-x-hidden bg-gray-100 bg-no-repeat bg-cover bg-center bg-fixed" style="backkkkkground-image: url('bg.jpg'); font-family: arial,sans-serif;">
    <div class="w-screen top-0 fixed" style="z-index: 1">
            <div style="background: #C70101" class="shadow-md">
                <div class="grid grid-cols-9 mb-4 mx-auto h-16" name="nav-bar" style="width: 752px; background: #C70101">
                    <div name="image">
                        <img src="https://media.api-sports.io/teams/4501.png" class="w-12 ml-3 mt-2">
                    </div>

                    <a id="dashboard-button" href="javascript:showSection('dashboard');" class="navbar col-span-2 text-center font-bold text-sm no-underline hover:text-white text-white">
                        <div name="home"  class="tracking-wider">
                            <span style="line-height:62px;">HOME</span>
                        </div>
                    </a>

                    <a id="matches-button" href="javascript:showSection('matches');" class="navbar col-span-2 text-center font-bold text-sm no-underline hover:text-white text-gray-400">
                        <div name="Matches"  class="tracking-wider">
                            <span style="line-height:62px;">MATCHES</span>
                    </div>
                    </a>

                    <a id="news-button" href="javascript:showSection('news');" class="navbar col-span-2 text-center font-bold text-sm no-underline hover:text-white text-gray-400">
                        <div name="News"  class="tracking-wider">
                            <span style="line-height:62px;">NEWS</span>
                        </div>
                    </a>

                    <a id="table-button" href="javascript:showSection('table');" class="navbar col-span-2 text-center font-bold text-sm no-underline hover:text-white text-gray-400">
                        <div name="table"  class="tracking-wider">
                            <span style="line-height:62px;">TABLE</span>
                        </div>
                    </a>


                </div>
            </div>
    </div>
    <div id="main" name="main" class="mt-20">
        @yield('main')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="js/app.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.2.4/gsap.min.js"></script>
    <script>
        function showSection(section) {
            const allSections = document.querySelectorAll('.section');
            allSections.forEach(element => {
                element.style.display = 'none';
            });
            document.querySelector("#" + section).style.display = 'block';
            const navbar = document.querySelectorAll('.navbar');
            navbar.forEach(element => {
                element.style.color = '#CBD5E0';
            });
            document.querySelector("#" + section + "-button").style.color = 'white';
        }
        function recentMatches() {
            var btnRecent = document.querySelector('#recentButton');
            var btnNext = document.querySelector('#nextButton');
            btnRecent.classList.add("bg-gray-700");
            btnRecent.classList.remove("bg-gray-500");

            btnNext.classList.add("bg-gray-500");
            btnNext.classList.remove("bg-gray-700");

            document.querySelector('#recentMatches').style.display = 'block';
            document.querySelector('#futureMatches').style.display = 'none';
        }
        function nextMatches() {
            var btnRecent = document.querySelector('#recentButton');
            var btnNext = document.querySelector('#nextButton');
            btnRecent.classList.add("bg-gray-500");
            btnRecent.classList.remove("bg-gray-700");

            btnNext.classList.add("bg-gray-700");
            btnNext.classList.remove("bg-gray-500");

            document.querySelector('#recentMatches').style.display = 'none';
            document.querySelector('#futureMatches').style.display = 'block';
        }
    </script>
</body>
</html>
