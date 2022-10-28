
{!! Html::script('js/cadastrousuariobottom.js') !!}
@extends('shared.table', ['card_name' => 'Listar Usuários',
'model_name_plural' => 'Usuários',
'model_name_singular' => 'Usuário',
'habilitar_pesquisa' => true,
'pesquisar' => 'Digite o nome do usuário cadastrado',
'route_search_name' => 'users',

'dados' => $users,
'ths' => ['Nome', 'Email', 'Cargo', 'Seção']])

@section('table-content')
@if (count($usuarios) > 0)
@foreach( $usuarios as $usuario  )
{!! Form::open(['route' => 'register']) !!}

<tr>
    <td >@include('admin.shared.attributes.nome', ['nome' => $usuario->nome ?? old('nome',$usuario->nome)]){{$usuario->nome}}</td>
    <td >@include('admin.shared.attributes.email', ['email' => $usuario->email ?? old('email',$usuario->email)]) {{ $usuario->email }}</td>
    <td >@include('admin.shared.attributes.cargo', ['cargos' => $cargos, 'cargo2' => $user->cargo_id ?? old('cargo_id')])</td>
    <td >@include('admin.shared.attributes.secao', ['secoes' => $secoes, 'secao2' => $user->secao_id ?? old('secao_id')])</td>
    @include('admin.shared.attributes.senha', ['label' => 'Senha', 'name' => 'password', 'required' => 'required' ?? old('senha',$usuario->password)   ])
        @include('admin.shared.attributes.senha', ['label' => 'Confirmação da Senha', 'name' => 'confirmacao_senha',
        'required' => 'required' ?? old('senha',$usuario->password)  ])
    <td >
        <div class=" col-lg-12 mb-2">
            <button id="confirmacadastrobutton" class="btn btn-success btn-block" type="submit"  >
                <i class="far fa-edit"></i><span id="confirmacadastrospan" >Confirmar Cadastro </span>
            </button>    
        </div>
    </td>
       

{{ Form::close() }}    
    <td>
            
                <form action="{{route('cadastros.destroy',$usuario)}}" method="post">
                         {{ csrf_field() }}
                        <button  type="submit" class="btn btn-danger ">
                        <i class="fa fa-fw fa-trash"></i>
                        Deletar {{$usuario->nome}}
                        </button></form>
            
        
    </td>
    
    
</tr> 

@endforeach
@endif
@endsection
