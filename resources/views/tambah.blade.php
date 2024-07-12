@extends('app')

@section('content')
<div class="container mt-5">
	<h1 class="text-center my-3">Multiple Input dengan Gambar</h1>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<a href="/laptop" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
				</div>
				<div class="card-body">
					<form action="/laptop" method="post" enctype="multipart/form-data">
						@csrf
						@method('POST')
						<div class="row">
							<div class="col-md-4 mb-2">
								<label for="merk">Merk Laptop</label>
								<input type="text" name="merk" class="form-control" required>
							</div>
							<div class="col-md-4 mb-2">
								<label for="gambar">Gambar Laptop</label>
								<input type="file" name="gambar" class="form-control" required>
							</div>
							<div class="col-md-4 mb-2">
								<label for="harga">Harga Laptop</label>
								<input type="text" name="harga" class="form-control" required>
							</div>
							<div class="col-md-12 mt-3">
								<div class="card">
									<div class="card-header">
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
							<div class="col-md-12 mt-3">
								<button class="btn btn-primary" type="submit">Submit</button>
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

        function tambahFitur(){
            i++;
            var form = `
                <div class="col-md-10" id="form`+i+`">
                    <input type="text" class="form-control mb-2" name="fields[`+i+`][fitur]" placeholder="Nama Fitur" required>
                </div>
                <div class="col-md-2" id="btn`+i+`">
                    <button class="btn btn-danger" type="button" onclick="hapusFitur()"><i class="fa fa-minus"></i></button>
                </div>`;
            $('#formFitur').append(form);
        }

        function hapusFitur(){
            if(i > 0){
                $('#form'+i).remove();
                $('#btn'+i).remove();
                i--;
            } else {
                i = 1;
            }
        }
    </script>
@endpush