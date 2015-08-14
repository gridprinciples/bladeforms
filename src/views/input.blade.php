@extends('form::block')

@section('inner')
    @if(isset($prefix) || isset($suffix))
        <div class="input-group {{ $group_class or '' }}">
        @if(isset($prefix))
            <div class="input-group-{{ isset($prefix_is_button) && $prefix_is_button ? 'btn' : 'addon' }}">{!! $prefix !!}</div>
        @endif
    @endif
    @if(isset($password) && $password)
        {!! Form::password($name, array_merge([
            'class' => 'form-control ' . (isset($class) ? ' ' . $class : ''),
        ], isset($attributes) ? $attributes : [])) !!}
    @else
        {!! Form::text($name, isset($value) ? $value : NULL, array_merge([
            'class' => 'form-control ' . (isset($class) ? ' ' . $class : ''),
        ], isset($attributes) ? $attributes : [])) !!}
    @endif
    @if(isset($prefix) || isset($suffix))
            @if(isset($suffix))
                <div class="input-group-{{ isset($suffix_is_button) && $suffix_is_button ? 'btn' : 'addon' }}">{!! $suffix !!}</div>
            @endif
        </div>
    @endif
@overwrite
