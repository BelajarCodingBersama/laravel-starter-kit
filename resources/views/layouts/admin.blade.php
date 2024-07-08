<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        @include('includes.favicon')

        @stack('before-style')
        @include('includes.style')
        @stack('after-style')

        <title>@yield('title')</title>
    </head>

    <body>
        <div class="screen-cover d-none d-xl-none"></div>

        <div class="row">
            @include('includes.sidebar')
            @yield('content')
        </div>

        @stack('before-script')
        @include('includes.script')
        @stack('after-script')
    </body>
</html>