@extends('snippets.form.block', [
    'name' => isset($name) ? $name : '', // Send "name" through since it's not needed, unlike normal
])

@section('inner')
    {!! $content or '' !!}
@overwrite
