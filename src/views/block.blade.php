<?php $forced_error = isset($error) ? $error : false; ?>
<div class="{{ $errors->first($name) ? ' has-error' : '' }} {{ $form_group_class or 'form-group' }}">
    @if(!isset($label) || $label !== FALSE)
        <label for="{{ $id or '' }}" class="{{ $label_class or 'col-sm-4' }} control-label">
            {!! $label or ucwords($name) !!}
        </label>
    @endif
    @if(!isset($control_size_class) || $control_size_class)
    <div class="{{ $control_size_class or 'col-sm-8' }}">
    @endif
        @yield('inner.form.group')
        @if($forced_error || $errors->first($name) || (isset($help) && $help))
            <div class="help-block">
                @if($forced_error)
                    {!! $forced_error !!}
                @elseif($errors->first($name))
                    {!! $errors->first($name) ? $errors->first($name) : '' !!}
                @else
                    {!! $help !!}
                @endif
            </div>
        @endif
    @if(!isset($control_size_class) || $control_size_class)
    </div>
    @endif
</div>
