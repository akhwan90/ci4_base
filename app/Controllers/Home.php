<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$db      = \Config\Database::connect();

		$builder = $db->table('barang');
		$query   = $builder->get()->getResultArray();

		echo var_dump($query);
		exit;

		return view('welcome_message');
	}

	//--------------------------------------------------------------------

}
