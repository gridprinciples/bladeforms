<x-form::input-wrapper :attributes="$wrapper->attributes">
    <input {{ $attributes->merge([
        ...compact('id', 'name', 'value'),
        'type' => ! $attributes->has('type') ? 'text' : null,
        'aria-describedby' => $id . '_feedback',
        'required' => $required ? '' : null,
    ]) }} />
</x-form::input-wrapper>