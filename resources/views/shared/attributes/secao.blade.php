
    <label for="secao_id"><strong>Unidade </strong></label>
    <select class="form-control "
            name="secao_id" id="secao_id">
        @foreach($secoes as $secao)
            @if(Auth::user()->secao->id === $secao->id && $secao2=='' )
                <option value="{{$secao->nome}}" selected>{{$secao->nome}}</option>
            @else
                <option value="{{ $secao->nome }}" {{ $secao->id == $secao2 ? 'selected=selected' : '' }}>
                    {{$secao->nome}}
                </option>
            @endif
        @endforeach
    </select>
  
