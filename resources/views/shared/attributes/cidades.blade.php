
    <label for="cidade_id"><strong>Destino </strong></label>
    <select class="form-control " name="cidade_id"
        id="cidade">
        <option></option>
        @foreach($cidades as $cidade)
        <option value="{{ $cidade->nome }}" {{ $cidade->nome == $cidade2 ? 'selected=selected' : '' }}>
            {{$cidade->nome}}
        </option>
        @endforeach
    </select>
   <strong> <span id="rua"></span></strong>
    <strong><span id="complemento"></span></strong>
    @include('shared.error_feedback', ['name' => 'cidade_id'])
