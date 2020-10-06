<main class="main">
	<!-- Breadcrumb-->
	<?php // $this->load->view('layout/breadcrumb');?>

	<div class="container-fluid mt-4">
		<div class="animated fadeIn">
			<div class="row">
				<!-- KONTEN SEPERTIGA TENGAH -->
				<div class="col-xl-12 col-lg-12 col-md-12">
					<div class="card">
						<div class="card-header"><i class="fa fa-home"></i> MENU ADMIN</div>
						<div class="card-body">
							<div class="alert alert-success"><h3>Aplikasi POS</h3></div>

							<div class="card">
								<div class="card-header">Detil Session</div>
								<div class="card-body">
									<pre><?=json_encode(session('username'), JSON_PRETTY_PRINT);?></pre>
								</div>
							</div>

						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</main>
