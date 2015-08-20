<?php
$multipleMode = (isset($options) && count($options) ? TRUE : FALSE);
?>

@extends('form::block', [
    'label' => $multipleMode ? $label : '&nbsp;',
])

@section('inner.form.group')
    @if($multipleMode)
        @foreach($options as $k => $v)
            <div class="checkbox">
                <input id="c{{ preg_replace('/[a-z\-_]/', '', strtolower($name)) }}" value="1" type="checkbox" name="{{ $name }}"{{ isset($value) && $value == $v ? ' checked="checked"' : '' }}>
                <label for="c{{ preg_replace('/[a-z\-_]/', '', strtolower($name)) }}">
                    <span></span>
                    {!! $label or ucwords($name) !!}
                </label>
            </div>
        @endforeach
    @else
        <div class="checkbox">
            <input id="c{{ preg_replace('/[a-z\-_]/', '', strtolower($name)) }}" value="1" type="checkbox" name="{{ $name }}"{{ (isset($value) && $value == $v) || Input::old($name) ? ' checked="checked"' : '' }}>
            <label for="c{{ preg_replace('/[a-z\-_]/', '', strtolower($name)) }}">
                <span></span>
                {!! $label or ucwords($name) !!}
            </label>
        </div>
    @endif
@overwrite
