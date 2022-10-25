@extends('shared.table', ['card_name' => 'Listar Usuários',
'model_name_plural' => 'Usuários',
'model_name_singular' => 'Usuário',
'habilitar_pesquisa' => true,
'pesquisar' => 'Digite o nome do usuário',
'route_search_name' => 'users',

'dados' => $users,
'ths' => ['Nome', 'Email', 'Cargo', 'Seção']])

@section('table-content')
@if (count($usuarios) > 0)


@foreach( $usuarios as $usuario  )
<tr>
    <td id="nome">{{$usuario->nome}}</td>
    <td id="email" > {{ $usuario->email }}</td>
    <td id="cargo"> {{ $usuario->cargo_id }}</td>
    <td id="secao"> {{ $usuario->secao_id }}</td>
    <td id="cadastro" >
    <div class=" col-lg-6 mb-2">
            <a class="btn btn-block btn-success float-right" href="{{route('register')}}">
                <i class="fa fa-plus"></i> Cadastrar 
            </a>
        </div>
    </td>
</tr>
@endforeach
@endif
@endsection

