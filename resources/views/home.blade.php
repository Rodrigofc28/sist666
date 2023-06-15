<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/home.css') }}">
</head>

<body onload="funcaocarregar()">


    






    <section id="home">
        <div class="home-container">
            <div class="home-logo">
                
                <!-- <video src="../image/web_logo.mp4" id="video" type="video/mp4" autoplay muted playsinline loop ></video> -->
               <span id="logo_anuncios">WEB ANUNCIOS</span>
            </div>

            

           
            <div class="actions">
                @auth
                <a class="btn-home-page" href="{{ route('dashboard') }}">
                    Home
                </a>
                @else
                <a class="btn-home-page" href="{{ route('login') }}">
                    Login
                </a>
                @endauth
                 <a href="{{ route('cadastros.index') }}" class="btn-solicita">CADASTRAR</a> 
            </div>
            <br>
           
            <a href="">Desenvolvedor Rodrigo de Freitas Camargo</a>
            
        </div>
    </section>
    <footer>

    </footer>
    @include('layout.scripts')
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
</body>

</html>