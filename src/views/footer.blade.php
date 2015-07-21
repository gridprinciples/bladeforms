<div class="{{ $wrapper_class or 'form-footer' }}">
    <div class="{{ $footer_class or 'pull-right' }}">
        @if(isset($cancel))
            <a href="{{ $cancel }}" class="btn btn-link">Cancel</a>
        @endif
        @include('form::submit')
    </div>
</div>
