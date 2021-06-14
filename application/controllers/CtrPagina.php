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

	public function room()
	{
		$this->load->view('pagina/room');
	}

	public function room_detalles()
	{
		$this->load->view('pagina/detalles_room');
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
