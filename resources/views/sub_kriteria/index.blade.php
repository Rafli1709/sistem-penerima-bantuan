@extends('layouts.default')

@push('styles')
    <!-- Datatables -->
    <link href="{{ asset('vendor/datatables/datatables.min.css') }}" rel="stylesheet">
@endpush

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
                        <li class="breadcrumb-item"><a class="disabled">Sub Kriteria</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach ($kriteria as $element)
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>{{ $element->nama }} ({{ $element->kode }})</h5>
                            <a href="{{ route('sub-kriteria.create', $element->id) }}" class="btn btn-sm btn-primary p-2"><i
                                    class="feather mr-2 icon-plus"></i>Tambah</a>
                        </div>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="datatables table table-hover ">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="40px">No</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center" width="200px">Nilai</th>
                                        <th class="text-center" width="120px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($element->subKriteria !== null)
                                        @foreach ($element->subKriteria as $data)
                                            <tr>
                                                <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                                <td class="align-middle">{{ $data->nama }}</td>
                                                <td class="text-center align-middle">{{ $data->nilai }}</td>
                                                <td class="align-middle">
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ route('sub-kriteria.edit', $data->id) }}"
                                                            class="btn btn-sm btn-icon btn-icon-square btn-info mr-2"><i
                                                                class="feather icon-edit"></i></a>
                                                        <form id="deleteForm"
                                                            action="{{ route('sub-kriteria.destroy', $data->id) }}"
                                                            method="post">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="button"
                                                                class="btn btn-sm btn-icon btn-icon-square btn-danger deleteButton"
                                                                data-name="{{ $data->nama }}"><i
                                                                    class=" feather icon-trash-2"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
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

        $('.datatables tbody').on('click', 'button.deleteButton', function() {
            let form = $(this).closest("form");
            let deleteButton = form.find('button.deleteButton');

            const name = deleteButton.data('name');

            Swal.fire({
                title: 'Apakah anda yakin?',
                text: `Anda akan menghapus data sub kriteria ${name}`,
                icon: 'warning',
                showCancelButton: true,
                reverseButtons: true,
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
@endpush
