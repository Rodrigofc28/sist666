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

<body>


    






    <section id="home">
        <div class="home-container">
            <!-- <div class="home-logo">
                <video src="../image/web_logo.mp4" type="video/mp4" autoplay muted playsinline loop ></video>
            </div> -->

            

            <h1>Sistema de Chat-Bot</h1>
            <h1>E-Commerce</h1>
            <h1>Formularios</h1>
            <h1>Criação de qr-code</h1>
            <div class="actions">
                
                <a class="btn-home-page" href="{{ route('home') }}">
                    Voltar
                
            </div>
            <br>
            
            
            
        </div>
    </section>
    <footer>

    </footer>
    @include('layout.scripts')
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
</body>

</html>