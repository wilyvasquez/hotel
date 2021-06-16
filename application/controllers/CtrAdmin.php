<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CtrAdmin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();        

        $this->load->helper('date');
        date_default_timezone_set('America/Monterrey');
    }

    public function principal()
	{
        $data = array(
            "vcredito"  => "active",
            "title"     => "Habitaciones",
            "subtitle"  => "Registro",
            "contenido" => "admin/habitaciones/habitaciones",
            "menu"      => "menu/menu_admin",
        );
        $this->load->view('universal/plantilla',$data);
	}
}
