@extends('auth.layout')

@push('styles')
    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endpush

@section('content')
    <div class="row align-items-center text-center">
        <div class="col-md-12">
            <div class="card-body">
                <img src="{{ asset('images/logo.png') }}" alt="" class="img-fluid mb-4" id="img-logo">
                <h4 class="f-w-400">Sign up</h4>
                <hr>
                <form action="{{ route('register.store') }}" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Nama" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" id="nik" name="nik" value="{{ old('nik') }}" placeholder="Nik" required>
                        @error('nik')
                            <div class="invalid-feedback text-left">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" placeholder="No HP (08xxxxxxxxxx)" required>
                        @error('no_hp')
                            <div class="invalid-feedback text-left">{{ $message }}</div>
                        @else
                            <small id="catatanNoHP" class="form-text text-muted text-left">Ketik dengan format 08xxxxxxxxx</small>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
                        @error('email')
                            <div class="invalid-feedback text-left">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <div class="position-relative">
                            <input type="password" class="form-control" id="_password" name="_password" value="{{ old('_password') }}" placeholder="Password" required>
                            <i class="feather icon-eye togglePassword"></i>
                        </div>
                        @error('_password')
                            <div class="invalid-feedback text-left">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-block btn-primary mb-4">Register</button>
                </form>
                <hr>
                <p class="mb-2">Sudah punya akun? <a href="{{ route('login.create') }}" class="f-w-400">Login</a></p>
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
