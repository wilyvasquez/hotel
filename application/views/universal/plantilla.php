<?php
	$this->load->view('universal/header');
	$this->load->view('universal/header_logo');
	// $this->load->view('universal/alerta_menssages');
	// $this->load->view('universal/alerta_notification');
	// $this->load->view('universal/alerta_tarea');
	$this->load->view('universal/cerrar_session');
	$this->load->view('universal/header_menu');
	$this->load->view($menu);
	$this->load->view('universal/navegacion_contenido');
	$this->load->view($contenido);
	$this->load->view('universal/footer');
?>