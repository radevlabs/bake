<input @include('bake::components.fields.tools.render-attributes')>
<div style="margin-top: 5px">
    @foreach($paths as $type => $path)
        @php($filename = explode('/', $path))
        @php($filename = end($filename))
        @if($type == 'image')
            <a href="{{ asset($path) }}" target="_blank">
                <span class="badge badge-info">
                    <i class="fa fa-eye"></i>
                    {{ $filename }}
                </span>
            </a>
        @else
            <a href="{{ asset($path) }}" download="{{ $filename }}">
                <span class="badge badge-info">
                    <i class="fa fa-download"></i>
                    {{ $filename }}
                </span>
            </a>
        @endif
        <input type="hidden" name="{{ $name }}" value="{{ $path }}">
    @endforeach
</div>
@push('js')
<script>
    $("#{{ $id }}_input").change(function (e) {
        var values = []
        var files = $(this).prop('files')
        if (files && files[0]) {
            for (file of files) {
                var fileReader = new FileReader()
                fileReader.name = file.name
                fileReader.addEventListener('load', function (fe) {
                    values.push({
                        name: fe.target.name,
                        data: fe.target.result
                    })
                })
                fileReader.readAsDataURL(file)
            }
            @this.set('value', values)
        }
    })
</script>
@endpush
