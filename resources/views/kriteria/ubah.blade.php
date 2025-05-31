@extends('layouts.default')

@push('styles')
    <!-- Custom Style -->
    <link href="{{ asset('/css/custom.css') }}" rel="stylesheet" />

    <!-- Select2 -->
    <link href="{{ asset('vendor/select2/css/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Kriteria</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('kriteria.index') }}">Kriteria</a></li>
                        <li class="breadcrumb-item"><a class="disabled">Ubah</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Ubah Data Kriteria</h5>
                </div>
                <div class="card-body ">
                    <form action="{{ route('kriteria.update', $kriteria->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="kode">Kode Kriteria</label>
                            <input type="text" class="form-control" id="kode" name="kode"
                                value="{{ $kriteria->kode }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Kriteria</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="{{ $kriteria->nama }}" required>
                        </div>
                        <div class="form-group">
                            <label for="jenis">Jenis Kriteria</label>
                            <select class="custom-select select-option" id="jenis" name="jenis" required>
                                <option value="Benefit" {{ $kriteria->jenis == 'Benefit' ? 'selected' : '' }}>Benefit
                                </option>
                                <option value="Cost" {{ $kriteria->jenis == 'Cost' ? 'selected' : '' }}>Cost</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi Kriteria</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ $kriteria->deskripsi }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('kriteria.index') }}" class="btn btn-danger"><i
                                class="feather mr-2 icon-rotate-ccw"></i> Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Select2 -->
    <script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.select-option').select2({
                minimumResultsForSearch: Infinity
            });
        });
    </script>
@endpush
