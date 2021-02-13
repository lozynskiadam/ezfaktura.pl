<div class="parameter">
    <div class="label">{{ $label }}</div>
    <div class="option">
        <select name="{{ $name }}" class="form-control">
            @foreach($options ?? [] as $value => $label)
                <option value="{{ $value }}">{{ $label }}</option>
            @endforeach
        </select>
    </div>
</div>