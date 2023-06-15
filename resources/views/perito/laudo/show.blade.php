@extends('layout.component')
@section('js')
{!! Html::script('js/filtrar_solicitantes.js') !!}
{!! Html::script('js/calendar.js') !!}
{!! Html::script('js/cropper.js') !!}
{!! Html::script('js/dropzone.js') !!}
{!! Html::script('js/dropzone_config.js') !!}
{!! Html::script('js/cropper_image.js') !!}
{!! Html::script('js/edicaoimagem.js') !!}
@endsection
@section('page')
<div class="col-8">
    <h4>Visão Geral do Laudo</h4>
   
   
      
</div>
<hr>
<div class="col-lg-12">
    {!! Form::open(['route' => ['laudos.update', $laudo], 'method' => 'patch']) !!}

    <input type="hidden" value="{{$laudo->id}}" id="laudo_id" name="laudo_id">
    <div class="form-group row">
        
        
       

        @include('perito.laudo.attributes.rep', ['rep' => $laudo->rep ?? old('rep')])
        @include('perito.laudo.attributes.oficio', ['oficio' => $laudo->oficio ?? old('oficio')])
        @include('perito.laudo.attributes.indiciado', ['indiciado' => $laudo->indiciado ?? old('indiciado')])
        @include('perito.laudo.attributes.tipo_inquerito', ['tipo_inquerito2' => $laudo->tipo_inquerito ??
        old('tipo_inquerito')])
        @include('perito.laudo.attributes.inquerito', ['inquerito' => $laudo->inquerito ?? old('inquerito')])

        @include('shared.input_calendar', ['label' => 'Data da Solicitação',
        'name' => 'data_solicitacao', 'size' => '3', 'value' => formatar_data_do_bd($laudo->data_solicitacao)])

        @include('shared.input_calendar', ['label' => 'Data da Designação',
        'name' => 'data_designacao', 'size' => '3', 'value' => formatar_data_do_bd($laudo->data_designacao)])
        @include('shared.input_calendar', ['label' => 'Data da ocorrência', 'name' => 'data_ocorrencia', 'size' => '3',
    'value' => formatar_data_do_bd($laudo->data_ocorrencia)])
    @include('shared.input_calendar', ['label' => 'Data do recebimento', 'name' => 'data_recebimento', 'size' => '3',
    'value' => formatar_data_do_bd($laudo->data_recebimento)])

        <input class="form-control" type="hidden" name="perito_id" autocomplete="off" value="{{ Auth::id() }}" />
        @include('shared.attributes.secao', ['secao2' => $laudo->secao_id ?? old('secao_id')])
        @include('shared.attributes.cidades', ['id' => 'cidade_id', 'size' => '4', 'cidade2' => $laudo->cidade_id ??
        old('cidade_id')])
        

        @include('perito.laudo.attributes.solicitante', ['solicitante2' => $laudo->solicitante_id ??
        old('solicitante_id')])
        @include('perito.laudo.attributes.boletim_ocorrencia',['boletim2'=>$laudo->boletim_ocorrencia??old('boletim')])
       
         
        
        
        <div class="col-lg-3 mt-auto">
            <button type="submit" id="salvar" class="btn btn-primary mt-2">
                <i class="far fa-save" aria-hidden="true"></i>
                Editar Informações
            </button>
        </div>
        {{ Form::close() }}
    </div>
</div>

<hr>

<div class="col-lg-12">
    <h4 class="mb-4">Material Periciado: </h4>
    @if(count( $laudo->imagens  )< 2)
    <div style="border:solid 1px orange; ">
    
        <form action="{{route('embalagem')}}" method="post"  enctype="multipart/form-data">
        {{ csrf_field() }}
            
        
            <h6><strong style="padding:10px "> Adicionar Imagens da Embalagem recebida {{count($laudo->imagens)}}/2 </strong> </h6>
            <input type="text" hidden name="laudo_id" value="{{$laudo->id}}">
            <input type="file"  name="fotoEmbalagem[]" multiple="multiple"id="" accept=".jpg, .jpeg, .png">
            <button type="submit" style="border:solid 0px;background:orange;color:white" >enviar</button>
           
            
           
        </form>
    @endif
        <hr>
        <div>
        
        
       @if(isset($laudo->imagens[0]->nome))
       
       
      <strong style="padding:10px">  Imagem das embalagens </strong><br>
        <img src="{{asset('../storage/imagensEmbalagem/'.$laudo->imagens[0]->nome)}}" style="width:100px;height:100px;padding:5px"alt="">
        <strong><a href="{{route('imagemExcluir',$laudo->imagens[0])}}" style="color:red">Excluir Imagem</a></strong>
        
        @endif
        @if(isset($laudo->imagens[1]->nome))
        <img src="{{asset('../storage/imagensEmbalagem/'.$laudo->imagens[1]->nome)}}" style="width:100px;height:100px;padding:5px"alt="">
       <strong><a href="{{route('imagemExcluir',$laudo->imagens[1])}}" style="color:red">Excluir Imagem</a> </strong>
        @endif  
        
    </div>
        
    </div>
    
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped" id="tabela_pecas">
            <thead align="center">
                <tr>
                    <th>Material</th>
                    <th>Marca</th>
                    <th>Calibre</th>
                    <th>Quantidade</th>
                    <th>Nº de Série</th>
                    <th>Nº do Lacre</th>
                    <th colspan="2">Ações</th>
                </tr>
            </thead>
            <tbody align="center">
                @includeWhen(count($armas) > 0, 'perito.laudo.partials.arma')
                @includeWhen(count($municoes) > 0, 'perito.laudo.partials.municao')
                @includeWhen(count($componentes) > 0, 'perito.laudo.partials.componente')
            </tbody>
        </table>
    </div>
    


    <div class="row mb-3">
        <div class="col-lg-3 mt-2">
            <a class="btn btn-secondary btn-block" href="{!! URL::previous() !!}">
                <i class="fas fa-arrow-circle-left"></i> Voltar</a>
        </div>

        <div class="col-lg-3 mt-2">
            <a class="btn btn-success btn-block" href="{{ route('laudos.materiais', $laudo )}}">
                <i class="fas fa-plus" aria-hidden="true"></i>
                Adicionar Material
            </a>
        </div>
        {{-- <div class="col-lg-3 mt-2">
            <a class="btn btn-success btn-block" href="{{ route('laudos.materiais', $laudo )}}">
        <i class="fas fa-camera" aria-hidden="true"></i>
        Adicionar Imagens
        </a>
    </div> --}}
    <div class="col-lg-3 mt-2">
        <a class="btn btn-primary btn-block" href="{{ route('laudos.docx', $laudo )}}">
            <i class="fas fa-file-download" aria-hidden="true"></i>
            Gerar Laudo (.docx)
        </a>
    </div>
</div>
</div>
@include('perito.modals.solicitante_modal')
@endsection
