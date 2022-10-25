<div class="col-lg-3">
    <div class="form-group">
        <label>Nº do Lacre saida *</label>
        <input disabled class="form-control{{ $errors->has('lacrecartucho') ? ' is-invalid' : '' }}"
               name="lacrecartucho" id="lacrecartucho" autocomplete="off" type="text"
               value="{{ old('lacrecartucho', $lacrecartucho) }}" required/>
        @include('shared.error_feedback', ['name' => 'lacre'])
    </div>
</div>