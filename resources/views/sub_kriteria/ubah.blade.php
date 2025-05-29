@extends('layouts.default')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Sub Kriteria</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('sub-kriteria.index') }}">Sub Kriteria</a></li>
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
                    <h5>Ubah Data Sub Kriteria</h5>
                </div>
                <div class="card-body ">
                    <form action="{{ route('sub-kriteria.update', $data->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nama">Nama Sub Kriteria</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="{{ $subKriteria->nama }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('sub-kriteria.index') }}" class="btn btn-danger"><i
                                class="feather mr-2 icon-rotate-ccw"></i> Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
