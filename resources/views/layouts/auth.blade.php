<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login | Bake</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('vendor/bake/assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bake/assets/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('vendor/bake/assets/modules/bootstrap-social/bootstrap-social.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/bake/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bake/assets/css/components.css') }}">

    <livewire:styles/>
</head>

<body>
<div id="app">
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="login-brand">
                        <img src="{{ asset('vendor/bake/assets/img/stisla-fill.svg') }}" alt="logo" width="100" class="shadow-light rounded-circle">
                    </div>
                    @yield('content')
                    <div class="simple-footer">
                        Bake 1.0
                    </div>
                </div>
            </div>
        </div>
    </section>
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

<!-- Page Specific JS File -->

<!-- Template JS File -->
<script src="{{ asset('vendor/bake/assets/js/scripts.js') }}"></script>
<script src="{{ asset('vendor/bake/assets/js/custom.js') }}"></script>

<livewire:scripts/>
</body>
</html>
