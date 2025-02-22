@extends('app')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-12">
                <!-- Card for editing laptop -->
                <div class="card shadow-sm border-danger">
                    <div class="card-header bg-danger text-white">
                        <a href="/laptop" class="btn btn-light text-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
                        <h4 class="mt-2">Edit Laptop</h4>
                    </div>
                    <div class="card-body">
                        <form action="/laptop/{{ $data->id }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <!-- Merk Laptop Input -->
                                <div class="col-md-4 mb-3">
                                    <label for="merk" class="form-label">Merk Laptop</label>
                                    <input type="text" class="form-control" name="merk" value="{{ $data->merk }}">
                                </div>

                                <!-- Gambar Laptop Input -->
                                <div class="col-md-4 mb-3">
                                    <label for="gambar" class="form-label">Gambar Laptop</label>
                                    <input type="file" name="gambar" class="form-control">
                                    <input type="hidden" name="dataGambar" value="{{ $data->gambar }}">
                                </div>

                                <!-- Harga Laptop Input -->
                                <div class="col-md-4 mb-3">
                                    <label for="harga" class="form-label">Harga Laptop</label>
                                    <input type="text" class="form-control" name="harga" value="{{ $data->harga }}">
                                </div>

                                <!-- Deskripsi Laptop Input -->
                                <div class="col-md-4 mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi Laptop</label>
                                    <input type="text" name="deskripsi" class="form-control" value="{{ $data->deskripsi }}" required>
                                </div>

                                <!-- Fitur Section -->
                                <div class="col-md-12 mt-3">
                                    <div class="card">
                                        <div class="card-header bg-warning text-dark">
                                            <button class="btn btn-success" type="button" onclick="tambahFitur()">Tambah Fitur</button>
                                        </div>
                                        <div class="card-body">
                                            <div class="row" id="formFitur">
                                                @foreach ($fitur as $i)
                                                    <div class="col-md-10" id="form{{ $loop->iteration.date('Y') }}">
                                                        <input type="hidden" name="update[{{ $loop->iteration.date('Y') }}][id]" value="{{ $i->id }}">
                                                        <input type="text" class="form-control mb-2" name="update[{{ $loop->iteration.date('Y') }}][fitur]" value="{{ $i->fitur }}">
                                                    </div>
                                                    <div class="col-md-2" id="btn{{ $loop->iteration.date('Y') }}">
                                                        <button class="btn btn-danger" type="button" onclick="deleteFitur({{ $loop->iteration.date('Y') }},{{ $i->id }})"><i class="fa fa-minus"></i></button>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-md-12 mt-3">
                                    <button class="btn btn-danger" type="submit">Update Laptop</button>
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

        // Add new feature input field dynamically
        function tambahFitur(){
            i++;
            var form = `
                <div class="col-md-10" id="form`+i+`">
                    <input type="text" class="form-control mb-2" name="add[`+i+`][fitur]" placeholder="Nama Fitur" required>
                </div>
                <div class="col-md-2" id="btn`+i+`">
                    <button class="btn btn-danger" type="button" onclick="hapusFitur(`+i+`)"><i class="fa fa-minus"></i></button>
                </div>`;
            $('#formFitur').append(form);
        }

        // Remove feature input field
        function hapusFitur(id){
            $('#form'+id).remove();
            $('#btn'+id).remove();
        }

        // Delete feature using AJAX
        function deleteFitur(id, idFitur){
            $.ajax({
                url: `/laptop/hapusFitur/${idFitur}`,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}', // Ensure to pass CSRF token if required
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                success: function(data) {
                    console.log('Item deleted:', data);
                    // Handle success response
                    $('#form'+id).remove();
                    $('#btn'+id).remove();
                },
                error: function(error) {
                    console.error('There was a problem with the delete request:', error);
                    // Handle error
                }
            });
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
