@extends('layouts.default')

@push('styles')
    <!-- Datatables -->
    <link href="{{ asset('vendor/datatables/datatables.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Perhitungan</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a class="disabled">Perhitungan</a></li>
                    </ul>
                </div>
                <div class="ml-auto">
                    <a href="{{ route('perhitungan.hitung') }}" class="btn btn-primary"><i
                            class="feather mr-2 icon-edit-2"></i>Hitung</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Matriks Perbandingan</h5>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="datatables table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center" width="20px">No</th>
                                    <th class="text-center">Nama</th>
                                    @foreach ($kriteria as $element)
                                        <th class="text-center" width="60px">{{ $element->kode }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($masyarakat as $element)
                                    <tr>
                                        <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                        <td class="align-middle">{{ $element->nama }}</td>
                                        @foreach ($element->penilaian as $item)
                                            <td class="text-center align-middle">{{ $item->subKriteria->nilai }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-center align-middle" colspan="2">Bobot</td>
                                    @foreach ($kriteria as $element)
                                        <td class="text-center align-middle">{{ $weight[$element->id] }}</td>
                                    @endforeach
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Perhitungan Nilai S</h5>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="datatables table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center" width="20px">No</th>
                                    <th class="text-center">Nama Pelapor</th>
                                    <th class="text-center" width="150px">Nilai S</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($masyarakat as $element)
                                    <tr>
                                        <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                        <td class="align-middle">{{ $element->nama }}</td>
                                        <td class="text-center align-middle">{{ $element->nilai_s }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-center align-middle" colspan="2">Total Nilai S</td>
                                    <td class="text-center align-middle">{{ $s_sum }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Perhitungan Nilai V dan Hasil Perankingan</h5>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="datatables-rangking table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">Nama Pelapor</th>
                                    <th class="text-center" width="150px">Nilai V</th>
                                    <th class="text-center" width="150px">Ranking</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sortMasyarakat as $element)
                                    <tr>
                                        <td class="align-middle">{{ $element->nama }}</td>
                                        <td class="text-center align-middle">{{ $element->nilai_v }}</td>
                                        <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Datatables -->
    <script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>

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

    <script>
        $(".datatables").dataTable();

        $(".datatables-rangking").dataTable({
            "order": [
                [2, "asc"]
            ]
        });
    </script>
@endpush
