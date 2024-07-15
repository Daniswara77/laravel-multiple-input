@extends('app')


@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<a href="/laptop" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<label for="merk" >Merk Laptop</label>
							<input type="text" id="merk"  class="form-control mb-3" value="{{ $data->merk }}" readonly>
							<label for="harga" >Harga Laptop</label>
							<input type="text" id="harga"  class="form-control mb-3" value="{{ $data->harga }}" readonly>
							
							<label for="gambar" >Gambar</label>
							<img src="{{ asset('storage/images/'.$data->gambar) }}" alt="" style="width: 100px;">
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">Fitur</div>
								<div class="card-body">
									@foreach ($fitur as $i)
									<p class="mb-2"><i class="fas fa-check"></i> {{ $i->fitur }}</p>
									@endforeach
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection