<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

  public function __construct() {
    parent::__construct();
  }

  public function registrar($usuario) {
    $this->db->insert('usuario', $usuario);
    return $this->db->insert_id();
  }

  public function logar($email, $senha) {
    $this->db->where('email', $email);
    $this->db->where('senha', $senha);
    return $this->db->get('usuario');
  }

  public function emailExiste($email) {
    $this->db->where('email', $email);
    $usuario = $this->db->get('usuario');
    return ($usuario->num_rows() > 0) ? true : false;
  }

  public function buscarUsuarioPorEmail($email) {
    $this->db->where('email', $email);
    $this->db->select('id, nome, email, telefone');
    return $this->db->get('usuario')->row();
  }

  public function buscarRedefinicaoSenhaPorId($idRedefinicaoSenha) {
    $this->db->where('id', $idRedefinicaoSenha);
    return $this->db->get('redefinicao_senha_usuario')->row();
  }

  public function redefinirSenha($idUsuario, $senha) {
    $this->db->where('id', $idUsuario);
    $this->db->set('senha', $senha);
    $this->db->update('usuario');
  }

  public function registrarInicioRedefinicaoSenha($redefinicaoSenha) {
    $this->db->insert('redefinicao_senha_usuario', $redefinicaoSenha);
    return $this->db->insert_id();
  }

  public function registrarFinalRedefinicaoSenha($idRedefinicaoSenha, $idUsuario, $redefinicaoSenha) {
    $this->db->where('id', $idRedefinicaoSenha);
    $this->db->where('id_usuario', $idUsuario);
    $this->db->update('redefinicao_senha_usuario', $redefinicaoSenha);
  }

  public function redefinicaoExpirou($idRedefinicaoSenha, $idUsuario) {
    $this->db->where('id', $idRedefinicaoSenha);
    $this->db->where('id_usuario', $idUsuario);
    $redefinicao = $this->db->get('redefinicao_senha_usuario');
    if ($redefinicao->num_rows() > 0) {
      $redefinicao = $redefinicao->row();
      $expirada    = $redefinicao->url_expirada;
      return ($expirada == 1) ? true : false;
    }else{
      return false;
    }
  }

  public function registrarUrlRedefinicaoSenha($idRedefinicaoSenha, $url) {
    $this->db->where('id', $idRedefinicaoSenha);
    $this->db->set('url', $url);
    $this->db->update('redefinicao_senha_usuario');
  }

  public function registrarEnvioEmailRedefinicaoSenha($idRedefinicaoSenha, $datetimeEmail) {
    $this->db->where('id', $idRedefinicaoSenha);
    $this->db->set('email_enviado_em', $datetimeEmail);
    $this->db->update('redefinicao_senha_usuario');
  }

}