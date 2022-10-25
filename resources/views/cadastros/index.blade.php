
<div class="col-8">

        <h4>Pedir solicitação de Cadastro</h4>
    </div>

    <form  action="{{ route('cadastros.store') }}" method="POST">
                {{ csrf_field() }}
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome"    riquered><br>
        <label for="cargo">Cargo:</label>
        <input type="text" name="cargo_id" id="cargo" riquered><br>
        <label for="secao">Seção:</label>
        <input type="text" name="secao_id" id="secao" riquered><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" riquered><br>
        <label for="password1">Senha:</label>
        <input type="password" name="password" id="senha" riquered><br>
        
    
        
        </div>
        <input type="submit" value="Enviar solicitação">


</form>




    
        
       

