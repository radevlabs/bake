@section('title', 'Dashboard')
<div>
    <div class="row">
        @foreach($totalCards as $tc)
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon {{ $tc->type }}">
                        <i class="{{ $tc->icon }}"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ $tc->name }}</h4>
                        </div>
                        <div class="card-body">
                            {{ $tc->total }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="card">
        <div class="card-header">
            <h4>Form example</h4>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="save($('#form').serializeArray())" id="form">
                @include('bake::components.fields.tools.render-fields', $fields)
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-2"></label>
                    <div class="col-sm-12 col-md-8">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
