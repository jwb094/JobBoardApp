<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @stack('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body id="top" class="app-shell flex min-h-screen flex-col">
    @include('include.header')
    <div class="app-shell__content flex-1">
        @yield('content')
    </div>
    @include('include.footer')
</body>
</html>
<!-- custom Scripts injection -->
@stack('other-scripts')
