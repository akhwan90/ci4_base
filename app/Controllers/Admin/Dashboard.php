<?php 
namespace App\Controllers\Admin;
use CodeIgniter\Controller;
use App\Controllers\BaseController;

class Dashboard extends BaseController {
	
	public function index() {
		$d['p'] = 'dashboard';
		$d['title'] = 'Dashboard';
		return view('template_admin', $d);
	}

}
