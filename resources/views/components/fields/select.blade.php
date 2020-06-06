<div wire:ignore>
    <select @include('bake::components.fields.tools.render-attributes')>
        @if(!$serverside)
            @foreach($resource as $row)
                <option @if(in_array($row['id'], $default)) selected @endif value="{{ $row['id'] }}">
                    {!! $row['text'] !!}
                </option>
            @endforeach
        @else
            @if(!empty($default))
                @foreach(DB::table(DB::raw("($resource)"))->whereIn('id', $default)->get() as $row)
                    <option selected value="{{ $row['id'] }}">
                        {!! $row['text'] !!}
                    </option>
                @endforeach
            @endif
        @endif
    </select>
</div>

@push('js')
    <script>
        $('#{{ $attributes['id'] }}').select2({
            placeholder: "{{ $attributes['placeholder'] }}",
            @if($serverside)
            ajax: {
                url: '{{ route('select2') }}',
                dataType: 'json',
                data: function (params) {
                    return {
                        q : $.trim(params.term),
                        queryTable : '{{ $resource }}'
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
            @endif
        });

        $('#{{ $attributes['id'] }}').on('change', function (e) {
            @this.set('value', $('#{{ $attributes['id'] }}').select2("val"))
        });
    </script>
@endpush
