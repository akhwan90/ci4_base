<?php 
namespace App\Controllers;
use CodeIgniter\Controller;

class Auth extends BaseController {
	
	public function index() {
		$d['title'] = "Login Aplikasi";
		$d['p'] = "login";
		
		return view('login', $d);
	}

	public function dashboard() {
		cek_login();

		$d['p'] = 'dashboard';
		return view('template_admin', $d);
	}

	public function d2() {
		cek_login();

	}

	public function logout() {
		$this->session->destroy();
		return redirect()->to('index');
	}

	public function login() {
		$var_post = $this->request->getPost();


		$builder = $this->db->table('admins');
		$builder->where('username', $var_post['usernames']);
		$data = $builder->get()->getRowArray();

		if (!empty($data)) {
			if (password_verify($var_post['passwords'], $data['password'])) {

				unset($data['password']);
				$newdata = $data;
				$newdata['is_login'] = true;
				$this->session->set($newdata);

				return redirect()->to('dashboard');
			} else {
				return redirect()->back()->with('error_login', '<div class="alert alert-danger">Login gagal (2)</div>');
			}
		} else {
			return redirect()->back()->with('error_login', '<div class="alert alert-danger">Login gagal (2)</div>');
		}
	}

}
