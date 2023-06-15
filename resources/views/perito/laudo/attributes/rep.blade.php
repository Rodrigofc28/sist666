<div class="col-lg-{{ $size ?? "3" }} mt-2">
    <label for="rep"><strong>KM inicial</strong></label>
    <input 
           name="KMinicial"  autocomplete="off" type="text"
           value="{{ old('rep', $rep) }}"  required/>
    @include('shared.error_feedback', ['name' => 'rep'])
</div>
<div class="col-lg-{{ $size ?? "3" }} mt-2">
    <label for="rep"><strong>KM Final</strong></label>
    <input 
           name="KMfinal"  autocomplete="off" type="text"
           value="{{ old('rep', $rep) }}"  required/>
    @include('shared.error_feedback', ['name' => 'rep'])
</div>