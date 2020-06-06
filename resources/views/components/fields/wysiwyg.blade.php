<div wire:ignore>
    @include('bake::components.fields.textarea')
</div>
@push('js')
    <script>
        $('#{{ $attributes['id'] }}').summernote({
            placeholder: '{{ $attributes['placeholder'] }}',
            dialogsInBody: true
        })

        $('#{{ $attributes['id'] }}').on('summernote.change', function (e) {
            @this.set('value', $('#{{ $attributes['id'] }}').summernote('code'))
        });
    </script>
@endpush
