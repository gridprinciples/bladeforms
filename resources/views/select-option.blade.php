@props(['label'])<option {{ $attributes->merge([
    'value' => $value,
    'selected' => $selected,
]) }}>{{ $label }}</option>