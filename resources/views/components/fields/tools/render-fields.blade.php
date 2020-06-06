@foreach($fields as $keyField => $field)
    @php
        $alias = $field->getComponentAlias();
        $data = $field->getData();
    @endphp
    @livewire($alias, ['data' => $data], key($keyField))
@endforeach
