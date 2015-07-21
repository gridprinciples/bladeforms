@extends('form::block')

@section('inner')
    @foreach($options as $k => $v)<div class="radio{{ isset($specify) && isset($specify[$k]) ? ' with-specification' : '' }}">
        {!! Form::radio($name, $k, isset($value) ? $value == $k : null, ['id' => 'c' . preg_replace('/[^a-z0-9\-_]/', '', strtolower($name . $k))]) !!}
        <label for="c{{ preg_replace('/[^a-z0-9\-_]/', '', strtolower($name . $k)) }}">
            <span></span>
            {!! $v !!}
        </label>
        @if(isset($specify) && isset($specify[$k]))
            <div class="specification">
                {!! $specify[$k] !!}
            </div>
        @else
            <div class="specification empty"></div>
        @endif
    </div>@endforeach
@overwrite
