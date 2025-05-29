@extends('layouts.default')

@push('styles')
    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endpush

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Ubah Password</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a class="disabled">Ubah Password</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Ubah Password</h5>
                </div>
                <div class="card-body ">
                    <form action="{{ route('profile.change-password.proses') }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="new_password">Password</label>
                            <div class="position-relative">
                                <input type="password" class="form-control password_input" id="new_password"
                                    name="new_password" value="{{ old('new_password') }}" required>
                                <i class="feather icon-eye togglePassword"></i>
                            </div>
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="new_password_confirmation">Konfirmasi Password</label>
                            <div class="position-relative">
                                <input type="password" class="form-control password_input" id="new_password_confirmation"
                                    name="new_password_confirmation" value="{{ old('new_password_confirmation') }}"
                                    required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('masyarakat.index') }}" class="btn btn-danger"><i
                                class="feather mr-2 icon-rotate-ccw"></i> Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $(".togglePassword").on("click", function() {
                const passwordInput = $(".password_input");
                const type = passwordInput.attr("type") === "password" ? "text" : "password";
                passwordInput.attr("type", type);
                $(this).toggleClass("icon-eye icon-eye-off");
            });
        });
    </script>
@endpush
