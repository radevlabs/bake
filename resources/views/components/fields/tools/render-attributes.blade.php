@foreach($attributes as $attr => $val)
    @if(!is_null($val))
        @if($val == '')
            {{ $attr }}
        @else
            {{ $attr }}="{{ $val }}"
        @endif
    @endif
@endforeach
