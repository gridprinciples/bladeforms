<form {{ $attributes->merge([
    'action' => $action,
    'method' => ($method === 'GET' ? 'GET' : 'POST'),
    'enctype' => ($multipart ? 'multipart/form-data' : null),
]) }}>
    @if($csrf)
        @csrf
    @endif
    @if(! in_array($method, ['GET', 'POST']))
        @method($method)
    @endif
    {{ $slot }}
</form>