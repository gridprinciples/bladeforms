@aware(['label', 'id', 'name', 'inputGroup', 'help', 'required', 'error'])

<fieldset {{ $attributes }}>
    @if ($label->hasActualContent() || ! empty(array_filter($label->attributes->all())))
    <legend {{ $label->attributes }}>{{ $label }}@if($required)@include('blade-forms::snippets.required-label')@endif</legend>
    @endif
    <div {{ $inputGroup->attributes }}>
        {{ $slot }}
    </div>
    <div id="{{ $id }}_feedback">
        @if ($errors->has($name) || $error)
        <div>{{ $error ?: $errors->first($name) }}</div>
        @endif
        @if ($help->hasActualContent())
        <div {{ $help->attributes }}>{{ $help }}</div>
        @endif
    </div>
</fieldset>