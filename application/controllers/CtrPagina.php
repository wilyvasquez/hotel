<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CtrPagina extends CI_Controller {

	public function __construct()
    {
        parent::__construct();        
        $this->load->library('openpay');

        $this->load->helper('date');
        date_default_timezone_set('America/Monterrey');
    }

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

	public function reservas_detalles()
	{
		$this->load->view('pagina/detalles_reservas');
	}

	public function gallery()
	{
		$this->load->view('pagina/gallery');
	}

	public function contacto()
	{
		$this->load->view('pagina/contact');
	}

	public function generarPago()
	{
		$this->load->view("pagina/formularioReservacion");
	}

	public function pago()
	{
		$titular   = $this->input->post("titular");
		$apellidos = $this->input->post("apellidos");
		$telefono  = $this->input->post("telefono");
		$correo    = $this->input->post("correo");

		$openpay = Openpay::getInstance('mnrbr41kikxabgldmh7s', 'sk_3655d46a8ca74bd5a7d4b2f37e5de594');
		$customer = array(
		     'name' => $titular,
		     'last_name' => $apellidos,
		     'phone_number' => $telefono,
		     'email' => $correo
		);

		$chargeRequest = array(
		    "method" => "card",
		    'amount' => 1234,
		    'description' => 'Cargo por reservacion de habitacion',
		    'customer' => $customer,
		    'send_email' => false,
		    'confirm' => false,
		    'redirect_url' => 'http://localhost/hotel/')
		;

		$charge = $openpay->charges->create($chargeRequest);

		echo $charge->serializableData["payment_method"]->url;
	}

	public function validarpago()
	{
		$openpay = Openpay::getInstance('mnrbr41kikxabgldmh7s', 'sk_3655d46a8ca74bd5a7d4b2f37e5de594');

		$customer = $openpay->customers->get('2lzzhsurnc9e');
		$payout = $customer->payouts->get('tr2lzzhsurnc9eublae8');

		echo "<pre>";
		print_r($payout);
		echo "</pre";
	}
}
