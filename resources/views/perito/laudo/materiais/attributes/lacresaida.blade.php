<div class="col-lg-3">
    <div class="form-group">
        <label>Nº do Lacre entrada </label>
        <input class="form-control{{ $errors->has('num_lacre') ? ' is-invalid' : '' }}"
               name="num_lacre_saida" autocomplete="off" type="text"
               value="{{ old('num_lacre_saida', $num_lacre_saida) }}"/>
        @include('shared.error_feedback', ['name' => 'lacre'])
    </div>
</div>