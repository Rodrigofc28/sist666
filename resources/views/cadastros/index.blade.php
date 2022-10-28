<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Solicitação de cadastro</title>
</head>
<body>
        <div>
                <div >

                        <h1>Polícia científica do paraná</h1>
                        <img src="image/logo.jpg" alt="">    
                        <h3>Pedir solicitação de Cadastro</h3>
                        
                        <form  action="{{ route('cadastros.store') }}" method="POST">
                                {{ csrf_field() }}
                                <label for="nome">Nome:</label>
                                <input type="text" name="nome" id="nome" required><br>
                                <label for="email">Email:</label>
                                <input type="email" name="email" id="email" requered><br>
                                <label for="password1">Senha:</label>
                                <input type="password" name="password" id="senha" requered><br>
                                <h6>*Senha deve conter no minimo 6 caracter.</h6>
                                <input type="submit" value="Enviar solicitação">
                                
                        </form>
                </div>        
        
                
        </div>
</body>
</html>

        
        






    
        
       

