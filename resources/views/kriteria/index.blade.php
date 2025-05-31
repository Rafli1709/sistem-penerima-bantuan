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
                        <h5 class="m-b-10">Kriteria</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a class="disabled">Kriteria</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('kriteria.create') }}" class="btn btn-primary"><i
                            class="feather mr-2 icon-plus"></i>Tambah</a>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="datatables table table-hover ">
                            <thead>
                                <tr>
                                    <th class="text-center" width="20px">No</th>
                                    <th class="text-center" width="100px">Kode</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center" width="200px">Bobot</th>
                                    <th class="text-center" width="200px">Jenis</th>
                                    <th class="text-center" width="400px">Deskripsi</th>
                                    <th class="text-center" width="120px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kriteria as $element)
                                    <tr>
                                        <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                        <td class="text-center align-middle">{{ $element->kode }}</td>
                                        <td class="align-middle">{{ $element->nama }}</td>
                                        <td class="align-middle">{{ $element->bobot }}</td>
                                        <td class="align-middle">{{ $element->jenis }}</td>
                                        <td class="text-wrap align-middle">{{ $element->deskripsi }}</td>
                                        <td class="align-middle">
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('kriteria.edit', $element->id) }}"
                                                    class="btn btn-sm btn-icon btn-icon-square btn-info mr-2"><i
                                                        class="feather icon-edit"></i></a>
                                                <form id="deleteForm"
                                                    action="{{ route('kriteria.destroy', $element->id) }}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="button"
                                                        class="btn btn-sm btn-icon btn-icon-square btn-danger deleteButton"
                                                        data-name="{{ $element->nama }}"><i
                                                            class=" feather icon-trash-2"></i></button>
                                                </form>
                                            </div>
                                        </td>
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

        $('.datatables tbody').on('click', 'button.deleteButton', function() {
            let form = $(this).closest("form");
            let deleteButton = form.find('button.deleteButton');

            const name = deleteButton.data('name');

            Swal.fire({
                title: 'Apakah anda yakin?',
                text: `Anda akan menghapus data kriteria ${name}`,
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
