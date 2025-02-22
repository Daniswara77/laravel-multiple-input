@extends('app')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-12">
                <!-- Card to display laptops -->
                <div class="card shadow-sm border-danger">
                    <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                        <h4><i class="fa fa-laptop"></i> Daftar Laptop</h4>
                        <a href="/laptop/create" class="btn btn-light text-danger"><i class="fa fa-plus"></i> Tambah Laptop</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead class="bg-danger text-white">
                                    <tr>
                                        <th>No</th>
                                        <th>Name Laptop</th>
                                        <th>Deskripsi</th>
                                        <th>Harga</th>
                                        <th>Gambar</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $i)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $i->merk }}</td>
                                        <td>{{ Str::limit($i->deskripsi, 50) }}</td>
                                        <td>Rp. {{ number_format($i->harga) }}</td>
                                        <td>
                                            <img src="{{ asset('storage/images/'.$i->gambar) }}" alt="{{ $i->merk }}" class="img-fluid" style="max-width: 100px;">
                                        </td>
                                        <td>
                                            <!-- View button -->
                                            <form action="/laptop/{{ $i->id }}" method="post" class="d-inline mx-1">
                                                @csrf
                                                @method('GET')
                                                <button class="btn btn-success mb-1" title="Lihat Detail"><i class="fas fa-eye"></i></button>
                                            </form>

                                            <!-- Edit button -->
                                            <form action="/laptop/{{ $i->id }}/edit" method="post" class="d-inline mx-1">
                                                @csrf
                                                @method('GET')
                                                <button class="btn btn-warning mb-1" type="submit" title="Edit Laptop"><i class="fas fa-edit"></i></button>
                                            </form>

                                            <!-- Delete button -->
                                            <form action="/laptop/{{ $i->id }}" method="post" class="d-inline mx-1">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger mb-1" type="submit" title="Hapus Laptop" onclick="return confirm('Apakah Anda ingin menghapus data ini?')"><i class="fas fa-trash"></i></button>
                                            </form>
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
    </div>
@endsection

@push('styles')
    <style>
        /* Custom styles for table */
        table.table th, table.table td {
            vertical-align: middle;
        }

        table.table-striped tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        /* Table hover effect */
        table.table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }

        /* Button hover effect */
        .btn:hover {
            opacity: 0.8;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
            }
        }
    </style>
@endpush
