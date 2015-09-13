@if (isset($errors) && count($errors) > 0)
    <div class="alert alert-danger">
        <p><strong>Whoops!</strong> There {{ $errors->count() === 1 ? 'was an error' : 'were some errors' }} with your input:</p>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
