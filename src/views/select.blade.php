@extends('form::block')

@section('inner.form.group')
    <select name="{{ $name }}{{ isset($multiple) && $multiple ? '[]' : '' }}"{!! isset($placeholder) ? ' placeholder="' . $placeholder . '"' : '' !!} class="form-control{{ !isset($basic) || !$basic ? ' selectize' : '' }}{{ isset($class) ? ' ' . $class : '' }}"{{ isset($multiple) && $multiple ? ' multiple' : '' }}{!! isset($id) && $id ? ' id="' . $id . '"' : '' !!}>
    @foreach($options as $k => $v)
        <option value="{{ $k }}"{{
                Input::old($name)
                    ?
                        (Input::old($name) == $k || (isset($multiple) && $multiple && is_array(Input::old($name)) && in_array($k, Input::old($name))) ? ' selected="selected"' : '')
                    :
                        (isset($value) && in_array($k, (array) $value) ? ' selected="selected"' : '')
            }}>{{ strip_tags($v) }}</option>
        @endforeach
    </select>
@overwrite
