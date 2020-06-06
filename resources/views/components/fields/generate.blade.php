@if($inline)
    <div class="form-group row mb-4">
        <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2">
            {!! $label ?? '' !!}
        </label>
        <div class="col-sm-12 col-md-8 col-lg-8">
            @include('bake::components.fields.'.$type)
            <div class="invalid-feedback">
                @error('value') {{ $message }} @enderror
            </div>
        </div>
    </div>
@else
    <div class="form-group row justify-content-center">
        <div class="col-12 col-md-8 col-lg-8">
            <label>
                {!! $label ?? '' !!}
            </label>
            @include('bake::components.fields.'.$type)
            <div class="invalid-feedback">
                @error('value') {{ $message }} @enderror
            </div>
        </div>
    </div>
@endif
