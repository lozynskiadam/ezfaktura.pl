<div class="form-group row @error($name) has-error @enderror ">
    <label for="{{ $name }}" class="col-form-label col-md-2">{{ $label }}</label>
    <div class="col-md-10">
        <input type="text" class="form-control" id="{{ $name }}" name="{{ $name }}" value="{{ old($name, $value) }}" @isset($disabled) disabled @endisset/>
        @error($name)
            <label class="text-danger small">{{ $message }}.</label>
        @enderror
    </div>
</div>
