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
                        <h5 class="m-b-10">Masyarakat</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('masyarakat.index') }}">Masyarakat</a></li>
                        <li class="breadcrumb-item"><a class="disabled">Tambah</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Tambah Data Masyarakat</h5>
                </div>
                <div class="card-body ">
                    <form action="{{ route('masyarakat.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="hubungan_keluarga">Hubungan Keluarga</label>
                            <select class="custom-select select-option" id="hubungan_keluarga" name="hubungan_keluarga"
                                required>
                                <option value=""></option>
                                <option value="Kepala Keluarga">Kepala Keluarga</option>
                                <option value="Istri">Istri</option>
                                <option value="Anak">Anak</option>
                                <option value="Orang Tua">Orang Tua</option>
                            </select>
                        </div>
                        @foreach ($kriteria as $item)
                            <div class="form-group">
                                <label for="kriteria-{{ $item->id }}">
                                    {{ $item->nama }}
                                    @if ($item->deskripsi)
                                        <span style="font-size: 12px;">({{ $item->deskripsi }})</span>
                                    @endif
                                </label>
                                <select class="custom-select select-option" id="kriteria-{{ $item->id }}"
                                    name="kriteria[{{ $item->id }}]" required>
                                    <option value=""></option>
                                    @foreach ($item->subKriteria as $element)
                                        <option value="{{ $element->id }}">{{ $element->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
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
    <!-- Select2 -->
    <script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.select-option').select2({
                placeholder: "-- Silahkan Pilih --"
            });
        });
    </script>
@endpush
