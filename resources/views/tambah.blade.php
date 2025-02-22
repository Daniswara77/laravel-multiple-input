@extends('app')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-12">
                <!-- Card for adding laptop -->
                <div class="card shadow-sm border-danger">
                    <div class="card-header bg-danger text-white">
                        <a href="/laptop" class="btn btn-light text-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
                        <h4 class="mt-2">Tambah Laptop Baru</h4>
                    </div>
                    <div class="card-body">
                        <form action="/laptop" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="row">
                                <!-- Merk Laptop Input -->
                                <div class="col-md-4 mb-3">
                                    <label for="merk" class="form-label">Merk Laptop</label>
                                    <input type="text" name="merk" class="form-control" required>
                                </div>

                                <!-- Gambar Laptop Input -->
                                <div class="col-md-4 mb-3">
                                    <label for="gambar" class="form-label">Gambar Laptop</label>
                                    <input type="file" name="gambar" class="form-control" required>
                                </div>

                                <!-- Harga Laptop Input -->
                                <div class="col-md-4 mb-3">
                                    <label for="harga" class="form-label">Harga Laptop</label>
                                    <input type="text" name="harga" class="form-control" required>
                                </div>

                                <!-- Deskripsi Laptop Input -->
                                <div class="col-md-4 mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi Laptop</label>
                                    <input type="text" name="deskripsi" class="form-control" required>
                                </div>

                                <!-- Fitur Section -->
                                <div class="col-md-12 mt-3">
                                    <div class="card">
                                        <div class="card-header bg-warning text-dark">
                                            <button class="btn btn-success" type="button" onclick="tambahFitur()">Tambah Fitur</button>
                                        </div>
                                        <div class="card-body">
                                            <div class="row" id="formFitur">
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control mb-2" name="fields[0][fitur]" placeholder="Nama Fitur" required>
                                                </div>
                                                <div class="col-md-2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-md-12 mt-3">
                                    <button class="btn btn-danger" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        var i = 0;

        function tambahFitur() {
            i++;
            var form = `
                <div class="col-md-10" id="form`+i+`">
                    <input type="text" class="form-control mb-2" name="fields[`+i+`][fitur]" placeholder="Nama Fitur" required>
                </div>
                <div class="col-md-2" id="btn`+i+`">
                    <button class="btn btn-danger" type="button" onclick="hapusFitur(`+i+`)"><i class="fa fa-minus"></i></button>
                </div>
            `;
            $('#formFitur').append(form);
        }

        function hapusFitur(i) {
            $('#form' + i).remove();
            $('#btn' + i).remove();
        }
    </script>
@endpush

@push('styles')
    <style>
        /* Form styling */
        .form-label {
            font-weight: bold;
        }

        /* Button styling for hover effects */
        .btn:hover {
            opacity: 0.8;
        }

        /* Card styling */
        .card-header {
            font-weight: bold;
        }

        .card-body {
            padding: 20px;
        }

        /* Make sure to keep the form well spaced on mobile */
        @media (max-width: 768px) {
            .row {
                margin-bottom: 10px;
            }
        }
    </style>
@endpush
