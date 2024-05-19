<x-form::input-wrapper :attributes="$wrapper->attributes">
    <textarea {{ $attributes->merge([
        ...compact('id', 'name'),
        'type' => ! $attributes->has('type') ? 'text' : null,
        'aria-describedby' => $id . '_feedback',
        'required' => $required ? '' : null,
    ]) }}>{{ $value }}</textarea>
</x-form::input-wrapper>