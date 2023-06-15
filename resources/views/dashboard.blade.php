@extends('layout.component')
@section('page')
     
        <h1>{{Auth::user()->nome}}</h1>
        <hr>
    <div class="dash" >  
        <span>Anuncios</span> 
        <!-- <img id="logo_policia_cientifica" src="../image/logo-sem-fundo.png" alt=""> -->
        
    </div> 
    <div>
        
        @if(isset($usuarios_mensagens) )
            @foreach($usuarios_mensagens as $usuario_mensagem)
                <div style="border: 2px solid black">
                    @if($usuario_mensagem->perito_id == Auth::user()->nome )
                      <strong><p style="color:green">{{$usuario_mensagem->perito_id}}</p></strong>  
                    @else
                      <strong><p style="color:red">{{$usuario_mensagem->perito_id}}</p></strong>  
                    @endif
                    <h4>{{$usuario_mensagem->mensagens}}</h4>
                    
                    <img src="{{asset('../storage/imagensUsuarios/'.$usuario_mensagem->upload_image)}}" controls style="max-width:100%" alt="">
                </div>
            @endforeach
        @endif 
    </div>
     @include('layout.scripts')
     
    <script>
        (function animacao(){
            $('#logo_policia_cientifica').animate({width: '0px'}, 'slow');
            $('#logo_policia_cientifica').animate({width: '250px'}, 'slow');
            
        })()
        
    </script>
@endsection
