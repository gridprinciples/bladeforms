@if($standalone)
    <x-form::control-set-wrapper :attributes="$wrapper->attributes">
        <x-slot:label></x-slot:label>
        <label {{ $wrapper->attributes }}>
            <input {{ $attributes->merge([
                'type' => 'checkbox',
                'name' => $name,
                'value' => $value,
                'checked' => (bool) old($name, $checked),
                'aria-describedby' => $id . '_feedback',
            ])->except(['required']) }} />
            <span {{ $label->attributes }}>{{ $label }}</span>
        </label>
    </x-form::control-set-wrapper>
@else
    <label {{ $wrapper->attributes }}>
        <input {{ $attributes->merge([
            'type' => 'checkbox',
            'name' => $name,
            'value' => $value,
            'checked' => $checked ? 'checked' : null,
            'aria-describedby' => $id . '_feedback',
        ])->except(['required']) }} />
        <span {{ $label->attributes }}>{{ $label }}</span>
    </label>
@endif