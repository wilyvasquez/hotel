<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CtrPagina extends CI_Controller {

	public function index()
	{
		$this->load->view('pagina/index');
	}

	public function about()
	{
		$this->load->view('pagina/about');
	}

	public function accomodation()
	{
		$this->load->view('pagina/accomodation');
	}

	public function gallery()
	{
		$this->load->view('pagina/gallery');
	}

	public function contacto()
	{
		$this->load->view('pagina/contact');
	}
}
