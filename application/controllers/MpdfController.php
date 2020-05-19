<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MpdfController extends CI_Controller {

	public function index()
	{
		$data = $this->load->view('mpdf_v');
	}

	public function printPDF()
	{
    $kirim['data'] = "aaa";
		$absen = new \Mpdf\Mpdf();
		$data = $this->load->view('hasilPrint', $kirim, TRUE );
		$absen->WriteHTML($data);
		$absen->Output();
	}

}
