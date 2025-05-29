@extends('auth.layout')

@push('styles')
    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endpush

@section('content')
    <div class="row align-items-center ">
        <div class="col-md-12">
            <div class="card-body">
                <img src="{{ asset('images/logo.png') }}" alt="" class="img-fluid mb-4" id="img-logo">
                <h4 class="mb-3 f-w-400">Login</h4>
                <hr>
                <form action="{{ route('login.store') }}" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}"
                            placeholder="Email" required>
                        @error('email')
                            <div class="invalid-feedback text-left">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <div class="position-relative">
                            <input type="password" class="form-control" id="password" name="password"
                                value="{{ old('password') }}" placeholder="Password" required>
                            <i class="feather icon-eye togglePassword"></i>
                        </div>
                        @error('password')
                            <div class="invalid-feedback text-left">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="custom-control custom-checkbox text-left mb-4 mt-2">
                        <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                        <label class="custom-control-label" for="remember">Ingat Saya</label>
                    </div>
                    <button type="submit" class="btn btn-block btn-primary mb-4">Login</button>
                </form>
                <hr>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $(".togglePassword").on("click", function() {
                const passwordInput = $(this).siblings("input");
                const type = passwordInput.attr("type") === "password" ? "text" : "password";
                passwordInput.attr("type", type);
                $(this).toggleClass("icon-eye icon-eye-off");
            });
        });
    </script>
@endpush
