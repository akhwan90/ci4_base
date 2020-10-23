<?php 
namespace App\Controllers\Admin;
use CodeIgniter\Controller;
use App\Controllers\BaseController;

class Soal extends BaseController {
	
	public function index() {
		$d['jenis_soal'] = $this->jenis_soal;

		$d['p'] = 'admin/soal';
		$d['js'] = 'soal';
		$d['title'] = 'Soal';
		return view('template_admin', $d);
	}

	public function detil_per_jenis($jenis, $bagian) {

		$d['p'] = 'admin/soal_detil_per_jenis';
		$d['js'] = 'soal';
		$d['title'] = 'Soal Jenis '.$jenis.' Bagian '.$bagian;
		$d['jenis'] = $jenis;
		$d['bagian'] = $bagian;

		return view('template_admin', $d);
	}

	public function form_soal($jenis, $bagian, $id_soal) {
		$idx_detil_jenis_soal = $jenis.$bagian;
		$detil_jenis_soal = $this->jenis_soal[$idx_detil_jenis_soal];

		// get detil isi soal = 
		if (intval($id_soal) > 0) {
			$builder = $this->db->table('m_soal');
			$builder->where('id', $id_soal);
	        $detil_soal = $builder->get()->getRowArray();
	    } else {
	    	$detil_soal = [
	    		'id'=>0,
	    		'jenis'=>$jenis,
	    		'bagian'=>$bagian,
	    		'soal_text'=>'',
	    		'opsi_text'=>"{'a':'','b':'','c':'','d':'','e':'','f':''}",
	    		'kunci'=>"[]",
	    	];
	    }

		$jml_harus_jawab = $detil_jenis_soal['jml_harus_jawab'];
		$multi_kunci = $detil_jenis_soal['multi_kunci'];
		$jml_opsi = $detil_jenis_soal['jml_opsi'];

		$opsi = ['a', 'b', 'c', 'd', 'e', 'f'];

		$form = '<form action="#" id="form_soal" method="post" enctype="multipart/form-data">
		<input type="hidden" name="jenis" id="jenis" value="'.$jenis.'">
		<input type="hidden" name="bagian" id="bagian" value="'.$bagian.'">
		<input type="hidden" name="id_soal" id="id_soal" value="'.$id_soal.'">

		<div class="form-group mb-4">
			<label>Soal</label>
			<input type="text" name="soal" id="soal" class="form-control" required value="'.$detil_soal['soal_text'].'">
			<input type="file" name="soal_file" id="soal_file" class="mt-1">
			<img src="" id="soal_preview" class="mt-2" style="width: 200px">
		</div>';

		$pecah_soal = json_decode($detil_soal['opsi_text'], true);
		$pecah_kunci = json_decode($detil_soal['kunci'], true);

		if ($jml_harus_jawab > 1 || $multi_kunci) {
			for ($j = 0; $j < $jml_opsi; $j++) {
				$idx_opsi = $opsi[$j];
				$selekted = '';
				if (in_array($idx_opsi, $pecah_kunci)) {
					$selekted = 'checked';
				}
				$value_opsi = empty($pecah_soal[$idx_opsi]) ? '' : $pecah_soal[$idx_opsi];

				$form .= '
				<div class="form-group mt-3">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">
								<input type="checkbox" name="kunci[]" id="opsi_text'.$opsi[$j].'" value="'.$opsi[$j].'" '.$selekted.'>
							</span>
						</div>
						<input type="text" name="opsi_text['.$opsi[$j].']" id="opsi_text_'.$opsi[$j].'" class="form-control" value="'.$value_opsi.'">
					</div>
				</div>
				<div class="form-group mt-1">
					<input type="file" name="opsi_file_'.$opsi[$j].'" id="opsi_file_'.$opsi[$j].'">
					<img src="#"  id="opsi_preview_'.$opsi[$j].'" class="mt-2" style="width: 200px">
				</div>';
			}
		} else {
			for ($j = 0; $j < $jml_opsi; $j++) {
				$idx_opsi = $opsi[$j];
				$selekted = '';
				if (in_array($idx_opsi, $pecah_kunci)) {
					$selekted = 'checked';
				}
				$value_opsi = empty($pecah_soal[$idx_opsi]) ? '' : $pecah_soal[$idx_opsi];

				$form .= '
				<div class="form-group mt-3">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">
								<input type="radio" name="kunci" id="opsi_'.$opsi[$j].'" value="'.$opsi[$j].'" '.$selekted.'>
							</span>
						</div>
						<input type="text" name="opsi_text['.$opsi[$j].']" id="opsi_text_'.$opsi[$j].'" class="form-control" value="'.$value_opsi.'">
					</div>
					<input type="file" name="opsi_file_'.$opsi[$j].'" id="opsi_file_'.$opsi[$j].'" class="mt-1">
					<img src="#"  id="opsi_preview_'.$opsi[$j].'" class="mt-2" style="width: 200px">
				</div>
				';
			}
		}

		$form .= '<div class="form-group mt-4">
			<div><label><input type="checkbox" name="setelah_simpan_input_lagi" value="1" checked> Setelah simpan, input lagi</label></div>

			<button type="submit" class="btn btn-primary btn-lg" id="tb_simpan"><i class="fa fa-check"></i> Simpan</button>
			<a href="'.base_url().'/admin/soal/detil_per_jenis/'.$jenis.'/'.$bagian.'" class="btn btn-secondary btn-lg"><i class="fa fa-arrow-left"></i> Kembali</a>
		</div>';
		$form .= '</form>';

		$d['p'] = 'admin/soal_form';
		$d['js'] = 'soal_form';
		$d['title'] = 'Form Soal';
		$d['html_form'] = $form;
		return view('template_admin', $d);
	}

	public function form_soal_save() {
		$p = $this->request->getPost();

		$idx_jenis_bagian = $p['jenis'].$p['bagian'];
		$dtl_jenis_bagian = $this->jenis_soal[$idx_jenis_bagian];

		$kunci = empty($p['kunci']) ? [] : (array) $p['kunci'];

		$jumlah_kunci = count($kunci);
		$setelah_simpan_input_lagi = empty($p['setelah_simpan_input_lagi']) ? 0 : intval($p['setelah_simpan_input_lagi']);

		if ($jumlah_kunci != $dtl_jenis_bagian['jml_harus_jawab']) {
			$ret = [
				'success'=>false,
				'message'=>'Jumlah kunci jawaban harus '.$dtl_jenis_bagian['jml_harus_jawab'],
				'id'=>0,
				'setelah_simpan_input_lagi'=>$setelah_simpan_input_lagi
			];
		} else if (count($kunci) < 1) {
			$ret = [
				'success'=>false,
				'message'=>'Kunci jawaban belum diinput..',
				'id'=>0,
				'setelah_simpan_input_lagi'=>$setelah_simpan_input_lagi
			];
		} else {
			$id_soal = intval($p['id_soal']);

			$pdata = [
				'jenis'=>$p['jenis'],
				'bagian'=>$p['bagian'],
				'soal_text'=>$p['soal'],
				'opsi_text'=>json_encode($p['opsi_text']),
				'kunci'=>json_encode($kunci),
			];

			if ($id_soal < 1) {
	            $builder = $this->db->table('m_soal');
				$queri = $builder->insert($pdata);
				$id = $this->db->insertID();
				$tipe = "insert";
			} else {
	            $builder = $this->db->table('m_soal');
	            $builder->where('id', $id_soal);
				$queri = $builder->update($pdata);
				$id = $id_soal;
				$tipe = "update";
			}

			// upload file 	
			$max_size = 2000000;
			$allowed_type_upload = ['jpg','png','gif'];

			$upload_opsi_ok = 0;
			$soal_gambar = "";
			$opsi_gambar = [];

			foreach ($_FILES as $opsi_file_k => $opsi_file_v) {
				if ($_FILES[$opsi_file_k]['name'] != "") {
					$substr_nama_file = substr($opsi_file_k, 0, 9);

					if ($substr_nama_file === "soal_file") {
						$nama_file = $substr_nama_file.'_'.str_pad($id, 6, '0', STR_PAD_LEFT);
					} else if ($substr_nama_file === "opsi_file") {
						$nama_file = $opsi_file_k.'_'.str_pad($id, 6, '0', STR_PAD_LEFT);
					} 

					$upload_yes = $this->upload_file($opsi_file_k, $allowed_type_upload, $max_size, "public/upload", $nama_file);

					if ($upload_yes === 0) {
						if ($substr_nama_file === "soal_file") {
							$soal_gambar = $nama_file;
						} else if ($substr_nama_file === "opsi_file") {
							$opsi_gambar[$opsi_file_k] = $nama_file;
						} 
						$upload_opsi_ok++;
					}
				}
			}

			$new_soal_gambar = $soal_gambar;
			$new_opsi_gambar = json_encode($opsi_gambar);

			$builder = $this->db->table('m_soal');
            $builder->where('id', $id_soal);
			$queri = $builder->update([
				'soal_gambar'=>$new_soal_gambar,
				'opsi_gambar'=>$new_opsi_gambar
			]);

			if ($queri) {
				$ret = [
					'success'=>true,
					'message'=>'Soal disimpan ('.$tipe.')',
					'id'=>$id,
					'setelah_simpan_input_lagi'=>$setelah_simpan_input_lagi
				];
			} else {
				$ret = [
					'success'=>false,
					'message'=>'Terjadi kesalahan',
					'id'=>0,
					'setelah_simpan_input_lagi'=>$setelah_simpan_input_lagi
				];
			}
		}

		return $this->response->setJSON($ret);
	}

	public function upload_file($name, $allowed, $max_size, $target, $filename, $replace=true) {
		$imageFileType = strtolower(pathinfo($_FILES[$name]["name"],PATHINFO_EXTENSION));
		$target_dir = ROOTPATH . $target;
		$target_file = $target_dir . '/' . $filename . '.' . $imageFileType;
		$uploadOk = 0;

		// Check if image file is a actual image or fake image
		$check = getimagesize($_FILES[$name]["tmp_name"]);
		if($check === false) {
			$uploadOk = 1;
		}

		// Check if file already exists
		if (!$replace) {
			if (file_exists($target_file)) {
				$uploadOk = 2;
			}
		}

		// Check file size
		if ($_FILES[$name]["size"] > $max_size) {
			$uploadOk = 3;
		}
		// Allow certain file formats
		if(!(in_array($imageFileType, $allowed))) {
			$uploadOk = 4;
		}

		if ($uploadOk === 0) {
			if (move_uploaded_file($_FILES[$name]["tmp_name"], $target_file)) {
				return $uploadOk;
			} else {
				return 5;
			}
		} else {
			return $uploadOk;
		}
	}

	public function datatabel_detil_jenis($jenis, $bagian) {

        if ($this->request->isAJAX()) {
			$p = $this->request->getPost();

            $start = $p['start'];
            $length = $p['length'];
            $draw = $p['draw'];
            $search = $p['search'];

            $builder = $this->db->table('m_soal');
            $builder->where('jenis', $jenis);
            $builder->where('bagian', $bagian);
            $builder->groupStart();
            $builder->like('soal_text', $search['value']);
            $builder->groupEnd();
            $builder->select('id');
            $d_total_row = $builder->countAll();

            // untuk data
            $b2 = $this->db->table('m_soal');
            $b2->where('jenis', $jenis);
            $b2->where('bagian', $bagian);
            $b2->groupStart();
            $b2->like('soal_text', $search['value']);
            $b2->groupEnd();
            $b2->select('*');
            $b2->limit($length, $start);
            $b2->orderBy('id', 'asc');
            $q_datanya = $b2->get()->getResultArray();


            $data = array();
            $no = ($start+1);
            
            foreach ($q_datanya as $d) {
                $data_ok = array();
            
                $link = '
                <a href="'.base_url().'/admin/soal/form_soal/'.$d['jenis'].'/'.$d['bagian'].'/'.$d['id'].'" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Edit</a>
                <a href="#" onclick="return hapus('.$d['id'].');" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Hapus</a>';
              
                $data_ok[] = $d['id'];
                $data_ok[] = $link;
                $data_ok[] = $d['soal_text'];

                $data[] = $data_ok;
            }

            $json_data = array(
				"draw" => $draw,
				"iTotalRecords" => $d_total_row,
				"iTotalDisplayRecords" => $d_total_row,
				"data" => $data
			);

			return $this->response->setJSON($json_data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
	}

	public function detil() {
		if ($this->request->isAJAX()) {
			$p = $this->request->getPost();

			$id = intval($p['id']);
			$builder = $this->db->table('m_peserta');
            $builder->where('id', $id);
            $builder->select('*');
            // echo $builder->getCompiledSelect();
            $data = $builder->get()->getRowArray();

            return $this->response->setJSON([
            	'success'=>true,
            	'results'=>$data
            ]);
		} else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
	}

	public function simpan() {
		if ($this->request->isAJAX()) {
			$p = $this->request->getPost();

			$validate = $this->validation->run($p, 'peserta');
			$errors = $this->validation->getErrors();


			$mode = $p['_mode'];
			$id = $p['_id'];

			$builder = $this->db->table('m_peserta');

			$data = [
		        'nama' => $p['nama'],
		        'nomor' => $p['nomor'],
		        'level_test' => $p['level_test'],
		        'usia' => $p['usia'],
		        'jenis_kelamin' => $p['jenis_kelamin'],
		        'pendidikan' => $p['pendidikan'],
			];

			if (!$errors) {
				if ($mode == "add") {
					// get id 
		            $builder->select('(IFNULL(MAX(id),0)+1) id_terakhir');
		            $builder->limit(1);
		            $builder->orderBy('id', 'desc');
		            $id_terakhir = $builder->get()->getRow()->id_terakhir;

		            $data['id'] = $id_terakhir;
					$queri = $builder->insert($data);
				} else {
					$builder->where('id', $id);
					$queri = $builder->update($data);
				}

				$success = false;
				if ($queri) {
					$success = true;
				}

	            return $this->response->setJSON([
	            	'success'=>$success,
	            	'message'=>'Tersimpan'
	            ]);
	        } else {
	        	return $this->response->setJSON([
	            	'success'=>false,
	            	'message'=>implode("\n", $errors)
	            ]);
	        }
		} else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
	}

	public function hapus() {
		if ($this->request->isAJAX()) {
			$p = $this->request->getPost();

			$id = $p['id'];

			$builder = $this->db->table('m_peserta');

			$builder->where('id', $id);
			$queri = $builder->delete();

			$success = false;
			if ($queri) {
				$success = true;
			}

            return $this->response->setJSON([
            	'success'=>$success,
            	'message'=>'Dihapus'
            ]);
		} else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
	}

}
