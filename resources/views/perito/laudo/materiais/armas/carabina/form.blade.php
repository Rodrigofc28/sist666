@section('js')
{!! Html::script('js/form_carabina.js') !!} 
@endsection


@if ($acao == 'Cadastrar')
{!! Form::open(['route' => ['carabinas.store', $laudo ]]) !!}
@elseif ($acao == 'Atualizar')
{!! Form::open(['route' => ['carabinas.update', $laudo, $carabina], 'method' => 'patch']) !!}
@else
{!! Form::open() !!}
@endif


<input type="hidden" name="laudo_id" id="laudo_id" value="{{ $laudo->id }}">
<input type="hidden" name="tipo_arma" id="tipo_arma" value="Carabina">

<div class="col-lg-12" style="padding: 0 5% 0">
    <div class="row mb-3">
        @include('perito.laudo.materiais.attributes.marca', ['marca2' => $carabina->marca->id ?? old('marca_id')])
        @include('perito.laudo.materiais.attributes.modelo', ['modelo' => $revolver->modelo ?? old('modelo')])
        @include('perito.laudo.materiais.attributes.origem', ['origem2' => $carabina->origem->id ?? old('origem_id')])
        @include('perito.laudo.materiais.attributes.calibre', ['obrigatorio' => true,'calibre2' => $carabina->calibre->id
        ?? old('calibre_id')])
        @include('perito.laudo.materiais.attributes.serie', ['tipo_serie2' => $carabina->tipo_serie ?? old('tipo_serie'),
        'num_serie' => $carabina->num_serie ?? old('num_serie')])
        @include('perito.laudo.materiais.attributes.numeracao_montagem', ['numeracao_montagem' =>
        $revolver->numeracao_montagem ?? old('numeracao_montagem')])
        @include('perito.laudo.materiais.attributes.carregamentocarabina', ['carregamento2' => $carabina->carregamento ??
        old('carregamento')])
        @include('perito.laudo.materiais.attributes.cao', ['cao2' => $carabina->cao ?? old('cao')])
        @include('perito.laudo.materiais.attributes.carregadorcarabina', ['carregador2' => $carabina->carregador ??
        old('carregador')])
        @include('perito.laudo.materiais.attributes.capacidade_carregador', ['capacidade_carregador' =>
        $carabina->capacidade_carregador ?? old('capacidade_carregador')])
        @include('perito.laudo.materiais.attributes.retem_carregador', ['retem_carregador2' =>
        $carabina->retem_carregador ?? old('retem_carregador')])
        
        @include('perito.laudo.materiais.attributes.trava_seguranca', ['trava_seguranca2' => $carabina->trava_seguranca
        ?? old('trava_seguranca')])
        @include('perito.laudo.materiais.attributes.tipo_acabamento', ['tipo_acabamento2' => $carabina->tipo_acabamento
        ?? old('tipo_acabamento')])
        @include('perito.laudo.materiais.attributes.coronha', ['coronha_fuste2' => $espingarda->coronha_fuste ??
        old('coronha_fuste')])
        @include('perito.laudo.materiais.attributes.estado_geral', ['estado_geral2' => $carabina->estado_geral ??
        old('estado_geral')])
        @include('perito.laudo.materiais.attributes.comprimento', ['comprimento_total' => $carabina->comprimento_total ??
        old('comprimento_total')])
        
        @include('perito.laudo.materiais.attributes.comprimento_cano', ['comprimento_cano' => $carabina->comprimento_cano
        ?? old('comprimento_cano')])
        @include('perito.laudo.materiais.attributes.quantidade_raias', ['quantidade_raias' => $carabina->quantidade_raias
        ?? old('quantidade_raias')])
        @include('perito.laudo.materiais.attributes.sentido_raias', ['sentido_raias2' => $carabina->sentido_raias ??
        old('sentido_raias')])
        @include('perito.laudo.materiais.attributes.funcionamento', ['funcionamento2' => $carabina->funcionamento ??
        old('funcionamento')])

        
        
        @include('perito.laudo.materiais.attributes.lacresaida', ['num_lacre_saida' => $carabina->num_lacre_saida ?? old('num_lacre_saida')])
        @include('perito.laudo.materiais.attributes.lacre', ['num_lacre' => $carabina->num_lacre ?? old('num_lacre')])
    </div>
    <div class="row justify-content-between mb-4">
        <div class="col-lg-4 mt-1">
            <a class="btn btn-secondary btn-block" href="{!! URL::previous() !!}">
                <i class="fas fa-arrow-circle-left"></i> Voltar</a>
        </div>
        @if($acao == 'Atualizar')
        <div class="col-lg-4 mt-1">
            <button class="btn btn-primary btn-block ver_imagens" type="button">
                <i class="fas fa-camera"></i> Visualizar Imagens</button>
        </div>
        @endif
        <div class="col-lg-4 mt-1">
            <button type="submit" class="btn btn-success btn-block submit_arma_form"><strong>
                    <i class="fas fa-plus" aria-hidden="true"></i> {{ $acao }}</strong>
            </button>
            {{ Form::close() }}
        </div>
    </div>
</div>
@include('perito.modals.calibre_modal', ['tipo_arma' => 'carabina'])
@include('perito.modals.marca_modal')
@include('perito.modals.pais_modal')
@if($acao == 'Atualizar')
@include('perito.modals.visualizar_imagens_modal', ['arma_id' => $carabina->id])
@endif