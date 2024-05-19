<label {{ $wrapper->attributes }}>
    <input {{ $attributes->merge([
        'type' => 'radio',
        'name' => $name,
        'value' => $value,
    ]) }} />
    <span {{ $label->attributes }}>{{ $label }}</span>
</label>