<main class="main">

	<div class="mt-3 ml-3 mr-3 mb-3">
		<div class="animated fadeIn">
			<div class="row">
				<!-- KONTEN SEPERTIGA TENGAH -->
				<div class="col-xl-12 col-lg-12 col-md-12">
					<div class="card">
						<div class="card-header"><i class="fa fa-home"></i> <?=$title;?></div>
						<div class="card-body">
							<a href="<?=base_url();?>/admin/soal/form_soal/<?=$jenis.'/'.$bagian.'/0';?>" class="btn btn-primary btn-lg col-md-12 mb-2">Tambah Soal</a>
							<a href="<?=base_url();?>/admin/soal" class="btn btn-secondary btn-lg col-md-12 mb-4">Kembali</a>

							<input type="hidden" name="jenis" value="<?=$jenis;?>" id="jenis">
							<input type="hidden" name="bagian" value="<?=$bagian;?>" id="bagian">

							<div class="table-responsive">
								<table class="table table-bordered table-sm" id="datatabel">
									<thead>
										<tr>
											<th width="5%" class="text-center">No</th>
											<th width="15%" class="text-center">Aksi</th>
											<th width="80%" class="text-center">Soal</th>
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
