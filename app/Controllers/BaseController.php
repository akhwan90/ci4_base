<?php
namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['form', 'my_helper'];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		$this->session = \Config\Services::session();
		$this->db = \Config\Database::connect();
		$this->validation = \Config\Services::validation();

		$this->jenis_soal = [
			'A1'=>['jenis'=>'A','bagian'=>1,'jml_soal'=>0,'jml_harus_jawab'=>1,'jml_opsi'=>6,'multi_kunci'=>false],
			'A2'=>['jenis'=>'A','bagian'=>2,'jml_soal'=>0,'jml_harus_jawab'=>2,'jml_opsi'=>5,'multi_kunci'=>false],
			'A3'=>['jenis'=>'A','bagian'=>3,'jml_soal'=>0,'jml_harus_jawab'=>1,'jml_opsi'=>6,'multi_kunci'=>false],
			'A4'=>['jenis'=>'A','bagian'=>4,'jml_soal'=>0,'jml_harus_jawab'=>1,'jml_opsi'=>5,'multi_kunci'=>false],
			'B1'=>['jenis'=>'B','bagian'=>1,'jml_soal'=>0,'jml_harus_jawab'=>1,'jml_opsi'=>5,'multi_kunci'=>false],
			'B2'=>['jenis'=>'B','bagian'=>2,'jml_soal'=>0,'jml_harus_jawab'=>1,'jml_opsi'=>5,'multi_kunci'=>false]
		];
	}

}
