<main class="main">

	<div class="mt-3 ml-3 mr-3 mb-3">
		<div class="animated fadeIn">
			<div class="row">
				<!-- KONTEN SEPERTIGA TENGAH -->
				<div class="col-xl-12 col-lg-12 col-md-12">
					<div class="card">
						<div class="card-header"><i class="fa fa-home"></i> <?=$title;?></div>
						<div class="card-body">
							<a href="#" onclick="return edit(0);" class="btn btn-success btn-lg col-md-12 mb-4">Tambah Data</a>

							<div class="table-responsive">
								<table class="table table-bordered table-sm" id="datatabel">
									<thead>
										<tr>
											<th width="5%" class="text-center">No</th>
											<th width="15%" class="text-center">Aksi</th>
											<th width="30%" class="text-center">Nama</th>
											<th width="15%" class="text-center">Level Test</th>
											<th width="10%" class="text-center">Usia</th>
											<th width="15%" class="text-center">Jenis Kelamin</th>
											<th width="10%" class="text-center">Pendidikan</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</main>

<div class="modal fade" id="mdl_edit" tabindex="-1" role="dialog" aria-labelledby="mdl_edit" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form method="post" action="#" onsubmit="return simpan();" id="mdl_edit_form">
				<input type="hidden" name="_id" id="_id">
				<input type="hidden" name="_mode" id="_mode">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><?=$title;?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="">Nomor</label>
						<input type="text" name="nomor" id="nomor" class="form-control">
					</div>
					<div class="form-group">
						<label for="">Nama</label>
						<input type="text" name="nama" id="nama" class="form-control">
					</div>
					<div class="form-group">
						<label for="">Level Test</label>
						<input type="text" name="level_test" id="level_test" class="form-control">
					</div>
					<div class="form-group">
						<label for="">Usia</label>
						<input type="number" name="usia" id="usia" class="form-control">
					</div>
					<div class="form-group">
						<label for="">Jenis Kelamin</label>
						<input type="text" name="jenis_kelamin" id="jenis_kelamin" class="form-control">
					</div>
					<div class="form-group">
						<label for="">Pendidikan</label>
						<input type="text" name="pendidikan" id="pendidikan" class="form-control">
					</div>
				</div>
				<div class="modal-footer">
					<button type="submi" class="btn btn-primary" id="mdl_edit_tb_save">Save</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>
