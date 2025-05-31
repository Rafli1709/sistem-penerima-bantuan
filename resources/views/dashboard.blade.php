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
                        <h5 class="m-b-10">Dashboard</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-md-6 summary">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-4 text-center">
                            <i class="icon feather icon-file-text text-c-red mb-1 d-block"></i>
                        </div>
                        <div class="col-8">
                            <h3>{{ $kriteria }}</h3>
                            <h6 class="text-muted m-b-0">Kriteria</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 summary">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-4 text-center">
                            <i class="icon feather icon-map text-c-green mb-1 d-block"></i>
                        </div>
                        <div class="col-8">
                            <h3>{{ $masyarakat }}</h3>
                            <h6 class="text-muted m-b-0">Masyarakat</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Sweet Alert 2 -->
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>

    @if (session('message'))
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('message') }}',
                icon: 'success',
                showConfirmButton: false,
                timer: 1500,
            });
        </script>
    @endif
@endpush
