<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body
    style="background-image: url(https://sun9-66.userapi.com/impg/38Ei7KIEK9aPy17UHjqwt77rkERU50A6i9zxDw/YA_w9j4xr5o.jpg?size=2000x1333&quality=96&sign=0c3f9b19ba27dbc53d54a675a563cba5&type=album); background-size: cover;">
<div id="app">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
        <div class="container">
            <style>
                .glowing-button {
                    transition: box-shadow 0.4s ease;
                }

                .glowing-button:hover {
                    box-shadow: 0 0 15px 5px rgba(0, 255, 81, 0.5);
                }
            </style>
            <a class="navbar-brand btn glowing-button glowing-button:hover" style="border-radius:2em"
               href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    @auth()
                        <li class="nav-item mx-1 glowing-button glowing-button:hover" style="border-radius:2em"><a
                                href="{{ route('cells.create') }}" class="btn text-white my-1"
                            >Добавить
                                клетку</a></li>
                        <li class="nav-item mx-1 glowing-button glowing-button:hover" style="border-radius:2em"><a
                                href="{{ route('animals.create') }}" class="btn text-white my-1"
                            >Добавить
                                животное</a></li>
                    @endauth
                    <li class="nav-item mx-1 glowing-button glowing-button:hover" style="border-radius:2em;"><a
                            href="{{ route('cells.index') }}"
                            class="btn text-white my-1"
                        >Все
                            клетки</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @auth()
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end " aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Выйти') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>

    </nav>

    <main class="p-3 align-content-center" style="min-height: 85vh;" id="element">
    @yield('content')


</div>
<button style="display:none;" id="show-button" onclick="fadeIn()">Показать</button>
<footer class="d-flex flex-wrap justify-content-between align-items-center p-3 mt-4 border-top link-light bg-dark"
        style="margin: 0 !important;">
    <p class="d-flex mb-0 ps-1 justify-content-start text-white">
        © virtualZoo 2024
    </p>

    <a href="{{route('home')}}"
       class="glowing-button glowing-button:hover fs-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 text-decoration-none mx-2 link-light p-2"
       style="border-radius:2em">
        virtualZoo
    </a>

</footer>
<script>
    const element = document.getElementById('element');
    const showButton = document.getElementById('show-button');

    function fadeIn() {
        element.style.opacity = 0;
        let opacity = 0;
        const interval = setInterval(() => {
            //Увеличение прозрачности на 0.25
            opacity += 0.25;
            //Применение новой прозрачности к элементу
            element.style.opacity = opacity;

            //Проверка достижения максимальной прозрачности
            if (opacity >= 1) {
                //Остановка интервала
                clearInterval(interval);
            }
        }, 50); //Задержка между кадрами анимации 35 миллисекунд
    }

    document.addEventListener('DOMContentLoaded', function () {
        showButton.click();
    });
</script>
</body>
</html>
