<div class="parameter">
    <div class="label">{{ $label }}</div>
    <div class="option">
        <select name="{{ $name }}" class="form-control">
            @foreach($options ?? [] as $option)
                <option>{{ $option }}</option>
            @endforeach
        </select>
    </div>
</div>