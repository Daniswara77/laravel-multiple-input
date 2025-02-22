@extends('app')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-12">
                <!-- Card to display laptop details -->
                <div class="card shadow-sm border-danger">
                    <div class="card-header bg-danger text-white">
                        <a href="/laptop" class="btn btn-light text-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
                        <h4 class="mt-2">Detail Laptop</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Left side: Laptop details -->
                            <div class="col-md-6 mb-4">
                                <label for="merk" class="form-label">Merk Laptop</label>
                                <input type="text" id="merk" class="form-control mb-3" value="{{ $data->merk }}" readonly>

                                <label for="harga" class="form-label">Harga Laptop</label>
                                <input type="text" id="harga" class="form-control mb-3" value="{{ $data->harga }}" readonly>

                                <label for="deskripsi" class="form-label">Deskripsi Laptop</label>
                                <input type="text" id="deskripsi" class="form-control mb-3" value="{{ $data->deskripsi }}" readonly>

                                <label for="gambar" class="form-label">Gambar</label>
                                <img src="{{ asset('storage/images/'.$data->gambar) }}" alt="Laptop Image" class="img-fluid" style="width: 150px;">
                            </div>

                            <!-- Right side: Fitur details -->
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header bg-warning text-dark">
                                        <strong>Fitur</strong>
                                    </div>
                                    <div class="card-body">
                                        @foreach ($fitur as $i)
                                            <p class="mb-2"><i class="fas fa-check text-success"></i> {{ $i->fitur }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Style adjustments for the details page */
        .form-label {
            font-weight: bold;
        }

        .card-header {
            font-weight: bold;
        }

        .card-body {
            padding: 20px;
        }

        /* Customize image display */
        .img-fluid {
            max-width: 100%;
            height: auto;
        }

        /* Make the page mobile-responsive */
        @media (max-width: 768px) {
            .card-body {
                padding: 15px;
            }
        }
    </style>
@endpush
