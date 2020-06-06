@include('components.forms.textarea')

@push('js')
    <script>
        var {{ $id }} = CodeMirror.fromTextArea(document.getElementById('{{ $id }}'), {
            lineNumbers: true
        });
    </script>
@endpush
