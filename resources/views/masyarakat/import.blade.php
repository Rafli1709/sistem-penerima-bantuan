@extends('layouts.default')

@push('styles')
    <!-- Custom Style -->
    <link href="{{ asset('/css/custom.css') }}" rel="stylesheet" />
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
                        <li class="breadcrumb-item"><a class="disabled">Import</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Import Data Masyarakat</h5>
                </div>
                <div class="card-body ">
                    <form action="{{ route('import.process') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nama">File Import</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="import_file" name="import_file"
                                    required>
                                <label class="custom-file-label">Pilih berkas...</label>
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
            $('.custom-file-input').on('change', function() {
                var fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').html(fileName);
            });
        });
    </script>
@endpush
