@foreach($resource as $row)
    @php($rowAttrs = $attributes)
    @php($rowAttrs['id'] = $rowAttrs['id'].'_'.$loop->iteration)
    @php($rowAttrs['value'] = $row['id'])
    <div class="custom-control custom-checkbox custom-control-inline">
        <input @include('bake::components.fields.tools.render-attributes', ['attributes' => $rowAttrs])>
        <label class="custom-control-label" for="{{ $rowAttrs['id'] }}">{{ $row['text'] }}</label>
    </div>
@endforeach
