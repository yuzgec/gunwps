<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {!! SEO::generate() !!}
    @include('frontend.layout.css')
    @yield('customCSS')
    @livewireStyles
</head>
<body>
<div class="body">
    @include('frontend.layout.rental.header')
    <div role="main" class="main">
        @include('backend.layout.alert')

        @if (session('success'))
            <div class="text-center">
                <div class="alert alertt alert-success text-white">
                    <h5>{!! session('success') !!}</h5>
                </div>
            </div>

        @endif
        @yield('content')

    </div>
    @include('frontend.layout.footer')
</div>

@include('frontend.layout.js')
@yield('customJS')
@livewireScripts

</body>
</html>
