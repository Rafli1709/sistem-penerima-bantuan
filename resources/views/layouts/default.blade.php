<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ isset($title) ? $title . ' - ' . config('app.name') : config('app.name') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    @include('layouts.partials.styles')

    @stack('styles')
</head>

<body>
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>

    @include('layouts.partials.sidebar')

    @include('layouts.partials.header')

    <div class="pcoded-main-container">
        <div class="pcoded-content">
            @yield('content')
        </div>
    </div>

    @include('layouts.partials.scripts')

    @stack('scripts')
</body>

</html>
