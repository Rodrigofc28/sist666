@extends('layout.component')
@section('page')
    <div class="col-8">
        <h4>Cadastro de Metralhadora</h4>
    </div>
    <hr>
    @include('perito.laudo.materiais.armas.metralhadora.form', ['acao' => 'Cadastrar'])
@endsection