@extends('layout.component')
@section('js')
{!! Html::script('js/calendar.js') !!}
{!! Html::script('js/filtrar_solicitantes.js') !!}
{!! Html::script('js/imagecirculo.js') !!}
@endsection
@section('page')
<div class="col-8">
@php
  $msg = session('msg');
@endphp
    <h2><strong> FORMULÁRIO DE INSPEÇÃO VEÍCULAR</strong></h1>
    @if( $msg )
    <p style="color:green;">Adicionado Com Sucesso</p>
    
    @endif
</div>
<hr>
{{ Form::open(['route' => 'formularios.store', 'enctype' => 'multipart/form-data']) }}
<h4><strong>Dados</strong></h4>
<div style="max-width:100%" >
        <label for="secao_id"><strong>Unidade</strong> </label>
        <select name="secao_id" id="secao_id" class="form-control">
                
              <option></option> 
            @foreach($secoes as $secao)
            
                    <option value="{{ $secao->nome }}" >
                        {{$secao->nome}}
                    </option>
              
            @endforeach
        </select>
        


        <label for="cidade_id"><strong>Destino</strong></label>
        <select  name="cidade_id"
            id="cidade" class="form-control">
            <option></option>
            @foreach($cidades as $cidade)
            <option >
                {{$cidade->nome}}
            </option>
            @endforeach
        </select>
      
    <label for="d"><strong>RG</strong>&nbsp;</label><input type="text" maxlength="12" placeholder="xxxxxxxx-x" class="form-control" name="rg" id="d" require>
    <label for="d"><strong>Data</strong>&nbsp;</label><input type="date" class="form-control" name="data" id="d" require>
    <label for="h"><strong>Hora</strong>&nbsp;</label><input type="time" class="form-control" name="hora" id="h" require>
    <label for="p"><strong>Placa</strong>&nbsp;</label><input type="text" class="form-control" name="placa" id="p" require>
    <label for="c"><strong>Condutor</strong>&nbsp;</label><input type="text" class="form-control" name="condutor" id="c" require>
    <label for="d"><strong>KM</strong>&nbsp;</label><input type="text" class="form-control" name="km" id="d" require>
    @php
    $carros=['Duster','Caminhonete']
    @endphp
    <span><strong>Veiculo:</strong></span>
    <select name="veiculo" id="v" class="form-control">
    <option></option>
      @foreach( $carros as $carro)
      <option value="{{$carro}}">{{$carro}}</option>
      @endforeach
    </select>
</div>
<hr>
<h4><strong>Condição do carro</strong></h4>
<label for="r"><strong>Riscado</strong>&nbsp;</label><input type="radio" name="condicao" value="riscado" id="r" checked><br>
<label for="a"><strong>Amassado</strong>&nbsp;</label><input type="radio" name="condicao" value="amassado"id="a"><br>
<label for="q"><strong>Quebrado</strong>&nbsp;</label><input type="radio" name="condicao" value="quebrado"id="q"><br>
<label for="sd"><strong>Sem Danos</strong>&nbsp;</label><input type="radio" name="condicao" value="sem danos" id="sd">
<hr>
<h4><strong>condição pneu</strong></h4>
<label for="n"><strong>Novo</strong>&nbsp;</label><input type="radio" name="pneu" value="novo" checked id="n"><br>
<label for="b"><strong>Bom</strong>&nbsp;</label><input type="radio" name="pneu" value="bom" id="b" ><br>
<label for="l"><strong>No Limite</strong>&nbsp;</label><input type="radio" name="pneu" value="limite" id="l" ><br>
<label for="sc"><strong>Sem condição</strong>&nbsp;</label><input type="radio" name="pneu" value="semcondicao" id="sc">
<hr>

<table >
    <th>Acessórios do carro</th>
    <tbody >
        <td >
           <h3>Estepe</h3>
              <label >Sim&nbsp;<input type="radio" name="estepe" value="sim"  checked ></label> <br>
              <label>Não&nbsp;<input type="radio" name="estepe" value="nao" > </label><br>
              <textarea name="estobs" class="form-control" id="" cols="20" rows="1" placeholder="Descreva"></textarea>
         
        </td>
        <td>
        <h3>Triangulo</h3>
          <label >Sim&nbsp;<input type="radio" name="triangulo" value="sim"  checked ></label>  <br>
          <label>Não&nbsp;<input type="radio" name="triangulo" value="nao" > </label> <br>
          <textarea name="triobs" id="" cols="20" class="form-control" rows="1" placeholder="Descreva"></textarea>
        </td>
        <td>
          <h3>Chave de Rodas</h3>
          <label >Sim&nbsp;<input type="radio" name="chaveroda" value="sim"  checked ></label>  <br>
          <label>Não&nbsp;<input type="radio" name="chaveroda" value="nao" > </label><br>
          <textarea name="chaobs" id="" cols="20" class="form-control" rows="1" placeholder="Descreva"></textarea> 
        </td>
        <td>
          <h3>Macaco</h3>
          <label >Sim&nbsp;<input type="radio" name="macaco" value="sim"  checked ></label>  <br>
          <label>Não&nbsp;<input type="radio" name="macaco" value="nao" > </label><br>
          <textarea name="macoobs" id="" cols="20" class="form-control" rows="1" placeholder="Descreva"></textarea> 
        </td>
    </tbody>

</table>

<hr>



<table class="responsive-table">
    <th>Demais componentes fluidos</th>
    <tbody>
        <td>
          <h3>Oléo</h3>
          <label >Bom&nbsp;<input type="radio" name="oleo" value="Bom"  checked ></label> <br>
          <label>Ruim&nbsp;<input type="radio" name="oleo" value="ruim" > </label><br>  
          <textarea name="oleoobs" id="" cols="20" class="form-control" rows="1" placeholder="Descreva"></textarea>
        </td>
        <td>
          <h3>Água</h3>
        <label >Bom&nbsp;<input type="radio" name="agua" value="Bom"  checked ></label> <br> 
          <label>Ruim&nbsp;<input type="radio" name="agua" value="ruim" > </label><br>
          <textarea name="aguaobs" id="" cols="20" rows="1" class="form-control" placeholder="Descreva"></textarea> 
        </td>
        <td>
          <h3>Água do Limpador</h3>
        <label >Bom&nbsp;<input type="radio" name="agualimpador" value="Bom"  checked ></label><br>  
          <label>Ruim&nbsp;<input type="radio" name="agualimpador" value="ruim" > </label><br>
          <textarea name="limpadorobs" id="" cols="20" class="form-control" rows="1" placeholder="Descreva"></textarea> 
        </td>
        <td>
          <h3>Palheta Parabrisa</h3>
        <label >Bom&nbsp;<input type="radio" name="palheta" value="Bom"  checked ></label>  <br>
          <label>Ruim&nbsp;<input type="radio" name="palheta" value="ruim" > </label> <br>
          <textarea name="palhetaobs" id="" cols="20" class="form-control" rows="1" placeholder="Descreva"></textarea>
        </td>
        <td>
          <h3>Iluminação Farois/Setas</h3>
        <label >Bom&nbsp;<input type="radio" name="faroes" value="Bom"  checked ></label>  <br>
          <label>Ruim&nbsp;<input type="radio" name="faroes" value="ruim" > </label> <br>
          <textarea name="faroisobs" id="" cols="20" class="form-control" rows="1" placeholder="Descreva"></textarea>
        </td>
    </tbody>

</table>

    <input type="hidden" name="imagem_base64Lat" id="imagem_base64Lat" >
    <input type="hidden" name="imagem_base64LatEsq" id="imagem_base64LatEsq" >
    <input type="hidden" name="imagem_base64Frent" id="imagem_base64Frent" >
    <input type="hidden" name="imagem_base64Tran" id="imagem_base64Tran" >
    

    <input class="form-control" type="hidden" name="perito_id" autocomplete="off" value="{{ Auth::id() }}" />
<h4><strong>Demais Considerações/Sugestões</strong></h4>
<textarea name="observacao" id="" class="form-control" cols="50" rows="3"></textarea>
<hr>
   

<hr>
<h4><strong>Marque clicando aonde aparece os defeitos</strong></h4>
<div id="duster">

  <img src="..\public\image\dusterLateralDireita.png" id="imaLat" name="a" onclick="adicionarCirculogenerico(event,'imaLat','imagem_base64Lat')"  alt="">  
  <img src="..\public\image\dusterFrente.png" id="fre" name="a" onclick="adicionarCirculogenerico(event,'fre','imagem_base64Frent')"  alt="">
  <img src="..\public\image\dusterLateralEsquerda.png" id="imgEsq" name="b" onclick="adicionarCirculogenerico(event,'imgEsq','imagem_base64LatEsq')"  alt=""> 
  
  <img src="..\public\image\dusterTraseira.png" id="tra" name="a" onclick="adicionarCirculogenerico(event,'tra','imagem_base64Tran')"  alt="">
</div>
<div id="caminhonete">

  <img src="..\public\image\caminhoneteLateralDireita.png" id="imaLat" name="a" onclick="adicionarCirculogenerico(event,'imaLat','imagem_base64Lat')"  alt="">  
  <img src="..\public\image\caminhoneteFrente.png" id="fre" name="a" onclick="adicionarCirculogenerico(event,'fre','imagem_base64Frent')"  alt="">
  <img src="..\public\image\caminhoneteLateralEsquerda.png" id="imgEsq" name="b" onclick="adicionarCirculogenerico(event,'imgEsq','imagem_base64LatEsq')"  alt=""> 
  
  <img src="..\public\image\caminhoneteTraseira.png" id="tra" name="a" onclick="adicionarCirculogenerico(event,'tra','imagem_base64Tran')"  alt="">
</div>
<hr>


    
        <button class="btn btn-success btn-block" type="submit">
             Salvar e gerar documento(.docx)
        </button>
    
    @php
    $laudo=(!empty(session('unidade'))?session('unidade'):"NDA");
    @endphp
    
    
    
   
    

{{ Form::close() }}

<input type="button" class="btn btn-primary btn-block" id="botao-refresh" value="Novo Formulario">


@include('perito.modals.solicitante_modal')
@endsection