<!DOCTYPE html>
<html lang="pt-BR">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Solicitação de cadastro</title>
        <link rel="stylesheet" href="{{ URL::asset('css/layout.css')}}">

</head>
<body class="corpo">
        <main id="main">
                <div>
                        @if ($errors->any())
                                <div class="alert alert-danger">
                                        <ul>
                                                @foreach ($errors->all() as $error)
                                                <li style="color:red;">{{ $error }}</li>
                                                @endforeach
                                        </ul>
                        </div>
                        @endif
                </div>
                        
              
                
                <div>
                        <div >
                       
                                <h1 class="titulo">FORMULÁRIO DE CADASTRO</h1>
                                <img src="" alt="">    
                                
                                <legend>
                                        <form  action="{{ route('cadastros.store') }}" method="POST">
                                                {{ csrf_field() }}
                                                <label for="nome">Nome completo:</label>
                                                <input type="text" name="nome" id="nome"  required><br>
                                                <label for="email">Email &nbsp;<ion-icon name="mail"></ion-icon>:</label>
                                                <input type="email" name="email"  requered><br>
                                               
                                                <label for="password1">Senha &nbsp;<ion-icon name="key"></ion-icon>:</label>
                                                <input type="password"  name="password" id="senha" requered><br>
                                                
                                                <h6 style="margin:0px;margin-top:3px">*Senha deve conter no minimo 8 caracter.</h6>
                                                <h6 >*Nome deve conter no minimo 6 caracter.</h6>
                                                
                                                <input type="submit" value="Enviar ">
                                                
                                        </form>
                                        
                                        <a href="{{ route('home') }}"><button>voltar para home <ion-icon name="home"></ion-icon></button></a>
                                        
                                </legend>
                        </div>        
                
                        
                </div>
        </main>
        <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
</body>
</html>

        
        






    
        
       

