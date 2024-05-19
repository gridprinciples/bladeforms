<x-form::control-set-wrapper :attributes="$wrapper->attributes">
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
        <x-form::checkbox 
            :name="$name . '[]'"
            :$label 
            :required="$required ? '' : null"
            :value="$optionValue"
            :checked="is_array($value) ? Arr::has(array_flip($value), $optionValue) : $value === $optionValue"
            :aria-describedby="$describedBy"
            :attributes="new \Illuminate\View\ComponentAttributeBag($attributes)" 
            />
    @endforeach
</x-form::control-set-wrapper>