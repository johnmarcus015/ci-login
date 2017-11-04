<?php if (!defined('BASEPATH')) {
  exit('No direct script access allowed');
}

class Auditoria_model extends CI_Model {

  public function __construct() {
    parent::__construct();
  }

  public function registrar($auditoria) {
    $this->db->insert('auditoria_usuario', $auditoria);
    return $this->db->insert_id();
  }

  public function atualizarAuditoria($auditoria) {
    $this->registrar($auditoria);
  }

  public function buscarUltimaAuditoriaPorEmailUsuario($email) {
    $this->db->where('email', $email);
    $usuario = $this->db->get('usuario');
    if ($usuario->num_rows() > 0):
      $usuario = $usuario->row();
      $this->db->where('id_usuario', $usuario->id);
      $this->db->order_by('id', 'desc');
      $this->db->limit(1);
      $auditoria = $this->db->get('auditoria_usuario');
      if ($auditoria->num_rows() > 0):
      	$ultimaAuditoria = $auditoria->row();
      	return $ultimaAuditoria;
      endif;
    endif;
  }

}
