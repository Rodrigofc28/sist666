
    @if(!empty($label))
        <label for="{{ $name }}" class="col-form-label"><strong>{{ $label }}  </strong></label>
    @endif
    @if(!empty($label2))
        <label for="{{ $name }}" class="col-form-label">{{ $label2 ?? ''}}</label>
    @endif
    <input class="form-control calendario  }}"
           type="text" id="{{ $id ?? $name }}" name="{{ $name }}"
           autocomplete="off" value="{{old($name) ?? $value}}"  placeholder="__/__/____"/>
    @include('shared.error_feedback', ['name' => $name])
