<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('title')</title>

    @stack('before-styles')
    <!-- CSS files -->
    <link href="{{ asset('admin/css/tabler.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ asset('admin/css/tabler-flags.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ asset('admin/css/tabler-payments.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ asset('admin/css/tabler-vendors.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ asset('admin/css/demo.min.css?1684106062') }}" rel="stylesheet" />
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>

    @stack('after-styles')
</head>

<body>
    <script src="{{ asset('admin/js/demo-theme.min.js?1684106062') }}"></script>

    <div class="page">
        <!-- Sidebar -->
        @include('components.sidebar')
        <!-- Content -->
        <div class="page-wrapper">
            @yield('content')
            <!-- Footer -->
            @include('components.footer')
        </div>
    </div>
    <!-- Libs JS -->
    @stack('before-scripts')
    <!-- Tabler Core -->
    <script src="{{ asset('admin/js/tabler.min.js?1684106062') }}" defer></script>
    <script src="{{ asset('admin/js/demo.min.js?1684106062') }}" defer></script>
    @stack('after-scripts')
</body>

</html>
