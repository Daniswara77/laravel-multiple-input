@extends('app')
@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<a href="/laptop" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
				</div>
				<div class="card-body">
					<form action="/laptop/{{ $data->id }}" method="post" enctype="multipart/form-data">
						@csrf
						@method('PUT')
						<div class="row">
							<div class="col-md-4">
								<label for="merk">merk Laptop</label>
								<input type="text" class="form-control" name="merk" value="{{ $data->merk }}">
							</div>
							<div class="col-md-4 mb-2">
								<label for="gambar">Gambar Laptop</label>
								<input type="file" name="gambar" class="form-control">
								<input type="hidden" name="dataGambar" value="{{ $data->gambar }}">
							</div>
							<div class="col-md-4">
								<label for="harga">Harga Laptop</label>
								<input type="text" class="form-control" name="harga" value="{{ $data->harga }}">
							</div>
							
							<div class="col-md-12 mt-3">
								<div class="card">
									<div class="card-header">
										<button class="btn btn-info" onclick="tambahFitur()" type="button"><i class="fa fa-plus"></i> Tambah Fitur</button>
									</div>
									<div class="card-body" >
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
							<div class="col-md-12 mt-3">
								<button class="btn btn-primary" type="submit">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('script')
    <script>
        var i = 0;

        function tambahFitur(){
            i++;
            var form = `
                <div class="col-md-10" id="form`+i+`">
                    <input type="text" class="form-control mb-2" name="add[`+i+`][fitur]" placeholder="Nama Fitur">
                </div>
                <div class="col-md-2" id="btn`+i+`">
                    <button class="btn btn-danger" type="button" onclick="hapusFitur(`+i+`)"><i class="fa fa-minus"></i></button>
                </div>`;
            $('#formFitur').append(form);
        }

        function hapusFitur(id){
            $('#form'+id).remove();
            $('#btn'+id).remove();
            
            var formFitur = document.getElementById('formFitur');
            var form = `
                <div class="col-md-10" id="form0">
                    <input type="text" class="form-control mb-2" name="add[0][fitur]" placeholder="Nama Fitur" required>
                </div>
                <div class="col-md-2" id="btn0">
                </div>
            `;
            if(formFitur.children.length === 0){
                formFitur.innerHTML = form;
            }
        }

        function deleteFitur(id,idFitur){
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
                    
                    var formFitur = document.getElementById('formFitur');
                    var form = `
                        <div class="col-md-10" id="form0">
                            <input type="text" class="form-control mb-2" name="add[0][fitur]" placeholder="Nama Fitur" required>
                        </div>
                        <div class="col-md-2" id="btn0">
                        </div>
                    `;
                    if(formFitur.children.length === 0){
                        formFitur.innerHTML = form;
                    }
                },
                error: function(error) {
                    console.error('There was a problem with the delete request:', error);
                    // Handle error
                }
            });
        }
    </script>
@endpush