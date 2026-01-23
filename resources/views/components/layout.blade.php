<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','Password Keeper')</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/uniformcss@1.0.0/dist/uniform.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flexboxgrid/6.3.1/flexboxgrid.min.css" type="text/css" >
    <script src="https://cdn.jsdelivr.net/npm/tailwind-ui-components@1.0.0/dist/index.min.js"></script> -->
    {{-- <link rel="stylesheet" href="{{ URL::asset('resources/css/app.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('resources/css/main.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/app.css') }}">
    <link href=" {{ asset('css/mycss.css') }}" rel="stylesheet">
    {{-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script> --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))

    @else

    @endif


</head>
<body>
    @include('include.header')
    @yield('content')
    @include('include.footer')
</body>
</html>
@stack('other-scripts')
