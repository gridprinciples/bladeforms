<label {{ $wrapper->attributes }}>
    <input {{ $attributes->merge([
        'type' => 'checkbox',
        'name' => $name,
        'value' => $value,
        'checked' => $checked ? 'checked' : null,
    ]) }} />
    <span {{ $label->attributes }}>{{ $label }}</span>
</label>