<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
{{--    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">--}}

    <title>{{$title}}</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @yield('links')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-800">
    <header class="sticky bg-slate-950 max-h-32 flex justify-between items-center px-4">
        <div class="w-1/3">
            <a href="/">
                <img src="{{ asset('imgs/logo.png') }}" alt="shop" class="object-scale-down h-32 w-96"/>
            </a>
        </div>

        @yield('upperNavi')
        <x-errors/>
        <div class="w-1/3 flex justify-between ">
            <livewire:user-menu />
            <livewire:dynamic-cart />
        </div>
    </header>

    <main>
        @yield('main')
    </main>

    <footer>
        @yield('footer')
    </footer>
</body>
</html>
