@extends('snippets.form.block')

@section('inner')
    {!! Form::textarea($name, isset($value) ? $value : NULL, array_merge([
    'class' => 'form-control' . (isset($class) ? ' ' . $class : ''),
    ], isset($attributes) ? $attributes : [])) !!}
@overwrite
