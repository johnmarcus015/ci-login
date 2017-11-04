<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

  public function __construct() {
    parent::__construct();
  	if(!$this->session->userdata('usuario_logado')){
  		$this->session->set_flashdata('erro', 'Por favor, efetue o login para acessar!');
  		redirect('auth/login','refresh');
  	}
  }

  public function index() {

  }

  public function perfil(){
  	$this->load->view('usuario/perfil');
  }

}
