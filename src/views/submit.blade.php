@if(isset($actions) && $actions)
<div class="btn-group dropup">
@endif
    <button class="btn {{ $submit_class or 'btn-primary' }}" type="submit"{!! isset($name) ? ' name="' . $name . '" value="1"' : '' !!}>
        {!! $label or 'Save' !!}
    </button>
@if(isset($actions) && $actions)
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu dropup dropdown-menu-right" role="menu" aria-labelledby="dropdownMenu1">
            <li role="presentation" class="dropdown-header">After saving:</li>
            @foreach($actions as $k => $v)
                <li role="presentation" class="has-radio"><a href="#">{!! Form::radio('after_action', $k, Request::segment(count(Request::segments())) == $k ? true : false, array('id' => 'rAfter' . ucwords($k))) !!}<label for="{{ 'rAfter' . ucwords($k) }}"><span></span>{!! $v !!}</label></a></li>
            @endforeach
        </ul>
    </div>
@endif
