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

	public function pago_realizado()
	{
		$id = $this->input->get("id");
		if (!empty($id)) {
			$cargo = $this->validarCargo($id);

			if ($cargo == "completed") {
				$img  = "pago_exitoso.png";
				$data = array(
					'status' => $cargo, 
					'cargo'  => date("Y-m-d H:i:s"), 
				);
			}else{
				$img = "Error.png";
			}
			$data["img"] = $img;
			$this->load->view("pagina/pago_realizado",$data);
		}
	}

	public function pago()
	{
		$titular   = $this->input->post("titular");
		$apellidos = $this->input->post("apellidos");
		$telefono  = $this->input->post("telefono");
		$correo    = $this->input->post("correo");

		$openpay = Openpay::getInstance('mnrbr41kikxabgldmh7s', 'sk_3655d46a8ca74bd5a7d4b2f37e5de594');
		$customer = array(
			'name'         => $titular,
			'last_name'    => $apellidos,
			'phone_number' => $telefono,
			'email'        => $correo
		);
		// $datos = $this->crearClienteOpenpay($customer);

		$chargeRequest = array(
			"method"         => "card",
			'amount'         => 123,
			'description'    => 'Cargo por reservacion de habitacion',
			'customer'       => $customer,
			'send_email'     => false,
			'confirm'        => false,
			'redirect_url'   => 'http://localhost/hotel/transaccion/')
		;

		// $customer = $openpay->customers->get($datos);
		$charge   = $openpay->charges->create($chargeRequest);

		echo $charge->serializableData["payment_method"]->url;
	}

	public function validarCargo($id)
	{
		$status = "Error";
		if (!empty($id)) {
			$openpay = Openpay::getInstance('mnrbr41kikxabgldmh7s', 'sk_3655d46a8ca74bd5a7d4b2f37e5de594');
			$charge  = $openpay->charges->get($id);
			$status  = $charge->status;
		}

		return $status;
		// $customer = $openpay->customers->get("afdwr8etk1f7qo58mryp");
		// $payout   = $customer->charges->get("trjzoozae2sbejpwcauo");

		// echo "<pre>";
		// print_r($charge->status);
		// echo "</pre";
	}

	public function crearClienteOpenpay($data)
	{
		$openpay = Openpay::getInstance('mnrbr41kikxabgldmh7s', 'sk_3655d46a8ca74bd5a7d4b2f37e5de594');

		$customerData = array(
			'external_id'      => date("YmdHis"),
			'name'             => $data["name"],
			'last_name'        => $data["last_name"],
			'email'            => $data["email"],
			'requires_account' => false,
			'phone_number'     => $data["phone_number"],
			'address'          => array(
				'line1'        => 'aqui',
				'line2'        => 'aqui',
				'line3'        => '',
				'state'        => 'Oaxaca',
				'city'         => 'Mexico',
				'postal_code'  => '68000',
				'country_code' => 'MX'
			)
	   );

		$customer = $openpay->customers->add($customerData);
		return $customer->id;
	}

	public function correo($correo)
	{
		$this->load->library('email');

        $config = array(
            "protocol"  => 'smtp',
            "smtp_host" => 'mail.gran-hotel-huatulco.com',
            "smtp_user" => 'info@gran-hotel-huatulco.com',
            "smtp_pass" => 'info.granhotelhuatulco',   
            "smtp_port" => '587',
            "charset"   => 'utf-8',
            "wordwrap"  => TRUE,
            "validate"  => true
        ); 
        $subject = 'Gran Hotel Huatulco';
        // $data    = array(
        //     'nombre' => $nombre,
        //     'title'  => $title,
        //     'texto'  => $texto 
        // );
        // $msg = $this->load->view('admin/correo/correo', $data, true);
        $msg = "hola mundo";

        $this->email
            ->from("info@gran-hotel-huatulco.com")
            ->to($correo)
            ->subject($subject)
            ->message($msg)
            // ->set_mailtype('html')
            ->send();

        if($this->email->send()){
        	return "success";
        }else{
			return "error";
        }

	}

	public function agregarSuscribe()
	{
		$correo = $this->input->post("email");
		echo $dato   = $this->correo($correo);
	}
}
