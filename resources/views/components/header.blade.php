<div class="section-header">
    <h1>@yield('title')</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item">
            <a href="{{ url('') }}"><i class="fas fa-home"></i></a>
        </div>
        @foreach(explode('/', request()->path()) as $path)
            <div class="breadcrumb-item">{{ ucwords($path) }}</div>
        @endforeach
    </div>
</div>
