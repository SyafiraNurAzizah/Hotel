<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hotel - BIM</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Google Font -->
    <link href={{ asset('https://fonts.googleapis.com/css?family=Lora:400,700&display=swap') }} rel="stylesheet">
    <link href={{ asset('https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap') }} rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href={{ asset('css/bootstrap.min.css') }} type="text/css">
    <link rel="stylesheet" href={{ asset('css/font-awesome.min.css') }} type="text/css">
    <link rel="stylesheet" href={{ asset('css/elegant-icons.css') }} type="text/css">
    <link rel="stylesheet" href={{ asset('css/flaticon.css') }} type="text/css">
    <link rel="stylesheet" href={{ asset('css/owl.carousel.min.css') }} type="text/css">
    <link rel="stylesheet" href={{ asset('css/nice-select.css') }} type="text/css">
    <link rel="stylesheet" href={{ asset('css/jquery-ui.min.css') }} type="text/css">
    <link rel="stylesheet" href={{ asset('css/magnific-popup.css') }} type="text/css">
    <link rel="stylesheet" href={{ asset('css/slicknav.min.css') }} type="text/css">
    <link rel="stylesheet" href={{ asset('css/style.css') }} type="text/css">
    
    {{-- @vite([
        'resources/sass/app.scss', 
        'resources/js/app.js'
    ]) --}}

    @stack('styles')
</head>
<body>
    <div class="app">
        <x-navbar />

        <div id="main-content">
            @yield('content')

            <x-footer />
        </div>
    </div>

    @stack('scripts')

    <!-- Js Plugins -->
    <script src={{ asset('js/jquery-3.3.1.min.js')}}></script>
    <script src={{ asset('js/bootstrap.min.js')}}></script>
    <script src={{ asset('js/jquery.magnific-popup.min.js')}}></script>
    <script src={{ asset('js/jquery.nice-select.min.js')}}></script>
    <script src={{ asset('js/jquery-ui.min.js')}}></script>
    <script src={{ asset('js/jquery.slicknav.js')}}></script>
    <script src={{ asset('js/owl.carousel.min.js')}}></script>
    <script src={{ asset('js/main.js')}}></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>