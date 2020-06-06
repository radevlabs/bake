<!DOCTYPE html>
<html lang="en" xmlns:livewire="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Bake</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('vendor/bake/assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bake/assets/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('vendor/bake/assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bake/assets/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bake/assets/modules/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bake/assets/modules/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bake/assets/modules/codemirror/lib/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bake/assets/modules/codemirror/theme/duotone-dark.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/bake/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bake/assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bake/assets/css/custom.css') }}">

    @stack('head')

    <livewire:styles/>
</head>

<body>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        @include('bake::components.navbar')
        @include('bake::components.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            <section class="section">
                @include('bake::components.header')
                @yield('content')
            </section>
        </div>
        @include('bake::components.footer')
    </div>
</div>

<!-- General JS Scripts -->
<script src="{{ asset('vendor/bake/assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bake/assets/modules/popper.js') }}"></script>
<script src="{{ asset('vendor/bake/assets/modules/tooltip.js') }}"></script>
<script src="{{ asset('vendor/bake/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/bake/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('vendor/bake/assets/modules/moment.min.js') }}"></script>
<script src="{{ asset('vendor/bake/assets/js/stisla.js') }}"></script>

<!-- JS Libraies -->
<script src="{{ asset('vendor/bake/assets/modules/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('vendor/bake/assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('vendor/bake/assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('vendor/bake/assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('vendor/bake/assets/modules/summernote/summernote-bs4.js') }}"></script>
<script src="{{ asset('vendor/bake/assets/modules/codemirror/lib/codemirror.js') }}"></script>
<script src="{{ asset('vendor/bake/assets/modules/codemirror/mode/javascript/javascript.js') }}"></script>

<!-- Page Specific JS File -->

<!-- Template JS File -->
<script src="{{ asset('vendor/bake/assets/js/scripts.js') }}"></script>
<script src="{{ asset('vendor/bake/assets/js/custom.js') }}"></script>

<livewire:scripts/>

@include('bake::components.alerts')

@stack('js')
</body>
</html>
