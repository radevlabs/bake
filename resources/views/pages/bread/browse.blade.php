@section('title')
    {!! $title !!}
@endsection
<div class="card card-primary">
    <div class="card-header">
        <h4>{!! $title !!}</h4>
        <div class="card-header-action">
            @foreach($links as $url => $text)
                <a href="{{ $url }}" class="btn btn-outline-info">
                    {!! $text !!}
                </a>
            @endforeach
        </div>
    </div>
    <div class="card-header">
        <div class="row" style="width: 100%">
            <div class="col-lg-3 col-md-3">
                <input wire:model="q" type="text" class="form-control" placeholder="{{ baketranslate('search', 'en') }}">
            </div>
            <div class="col-lg-7 col-md-7">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <input type="date" class="form-control" id="start-date">
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <input type="date" class="form-control" id="end-date">
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2">
                <div class="dropdown">
                    <a href="#" data-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle btn-block">
                        {{ $perPage }} {{ baketranslate('per page', 'en') }}
                    </a>
                    <div class="dropdown-menu">
                        @foreach($perPageMenu as $ppm)
                            <a class="dropdown-item"
                               onclick="@this.set('perPage', {{ $ppm }})"
                               style="cursor: pointer">
                                {{ $ppm }} {{ baketranslate('per page', 'en') }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div style="margin-left: 25px">
            {{ $rows->total() }} {{ baketranslate('data depand on filter', 'en') }}
            {{ empty($summaryFilter) ? '' : "($summaryFilter)" }}
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    @if($numbering)
                        <th scope="col">#</th>
                    @endif
                    @foreach($visibleFields as $vf)
                        <th scope="col" wire:click="sort('{{ $vf }}')" style="cursor: pointer">
                            {!! $aliases[$vf] ?? $vf !!}<br>
                            <small>
                                {{ ordinal($sortedFields[$vf]['order']) }}
                                {{ $sortedFields[$vf]['type'] }}
                            </small>
                        </th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                @foreach($rows as $idx => $row)
                    <tr>
                        @if($numbering)
                            <th scope="row">{{ $rows->firstItem() + $idx }}</th>
                        @endif
                        @foreach($visibleFields as $vf)
                            <td>{!! $casts[$vf]($row->{$vf}) !!}</td>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        {!! $rows->links() !!}
    </div>
</div>

@push('js')
    <script>
        $('#start-date').change(function () {
            @this.set('startDate', $('#start-date').val())
        })
        $('#end-date').change(function () {
            @this.set('endDate', $('#end-date').val())
        })
    </script>
@endpush
