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
    <h2><strong>ANUNCIAR</strong></h2>
    @if( $msg )
    <p style="color:green;">Adicionado Com Sucesso</p>
    
    @endif
</div>
<hr>
{{ Form::open(['route' => 'laudos.store', 'enctype' => 'multipart/form-data', 'files' => true]) }}


                    
                    
                    
                
                    <textarea name="mensagens" id="" style="max-width:100%" placeholder="MENSAGENS" cols="250" rows="10"></textarea>
                    
    
  
                   <!--  <input type="hidden" name="imagem_base64" id="imagem_base64"> -->
                    
                    <input class="form-control" type="hidden" name="perito_id" autocomplete="off" value="{{ Auth::user()->nome }}" />
                    <input type="file"  name="upload_image" id="">
    

<!-- <hr>
   <img src="..\image\marcador.jpg" id="ima" name="a" onclick="adicionarCirculogenerico(event,'ima','imagem_base64')"  alt="">
   
<hr> -->
    
    @php
    $laudo=(!empty(session('unidade'))?session('unidade'):"NDA");
    @endphp
    
        <button class="btn btn-success btn-block" type="submit">
             ENVIAR
        </button>
        <!-- <a class="btn btn-primary btn-block" href="{{ route('laudos.generate_docx',$laudo)}}">
            <i class="fas fa-file-download" aria-hidden="true"></i>
            Gerar Documento (.docx)
        </a> -->
        
    
    
    
   
    

{{ Form::close() }}

@include('perito.modals.solicitante_modal')
@endsection

