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
    <div class="auth-wrapper">
        <div class="auth-content text-center">
            <div class="card borderless">
                @yield('content')
            </div>
        </div>
    </div>

    @include('layouts.partials.scripts')

    @stack('scripts')
</body>

</html>
