<x-form::input-wrapper :attributes="$wrapper->attributes">
    <select {{ $attributes->merge([
        ...compact('id'),
        'name' => $multiple ? $name . '[]' : $name,
        'multiple' => $multiple ? '' : null,
        'aria-describedby' => $id . '_feedback',
        'required' => $required ? '' : null,
    ]) }}>
        <option></option>

        @foreach($options as $optionValue => $label)
            @if(is_array($label))
                @php
                    $attributes = $label;
                    $name = Arr::pull($attributes, 'name') ?: $name;
                    $optionValue = Arr::pull($attributes, 'value') ?: $optionValue;
                    $label = Arr::pull($attributes, 'label');
                    $describedBy = Arr::pull($attributes, 'aria-describedby') ?: $id . '_feedback';
                @endphp
            @else
                @php
                    $attributes = [];
                    $describedBy = $id . '_feedback';
                @endphp
            @endif

            @php $attributes = new \Illuminate\View\ComponentAttributeBag($attributes); @endphp

            <x-form::select-option 
                :$name
                :$label 
                :value="$optionValue"
                :selected="$multiple
                    ? (is_array($value) ? Arr::has(array_flip($value), $optionValue) : ($value === $optionValue))
                    : ($value === $optionValue)"
                :$attributes
                />
        @endforeach
    </select>
</x-form::input-wrapper>