<?php

//TODO
// OK - Criar tela de redefinicao expirada
// - Definir campos email, usuario como unique
// - Criar mascaras para inputs de formulario
// - Criar backend para gerenciamento de usuarios
// - Verificar alteracao de request para ajax

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('Auth_model');
    $this->load->model('Auditoria_model');
  }

  public function login() {
    $logar = $this->input->post('login');
    if (isset($logar)) {
      $this->validarFormularioLogin();
      $this->customizarMensagensValidacaoFormulario();
      if ($this->form_validation->run() == TRUE) {
        $email   = $this->input->post('email');
        $senha   = sha1($this->input->post('senha'));
        $usuario = $this->Auth_model->logar($email, $senha)->row();
        if (isset($usuario->email)) {
          $ultimaAuditoria = $this->Auditoria_model->buscarUltimaAuditoriaPorEmailUsuario($usuario->email);
          $infoSistema     = $this->obterSistemaUsuario();
          $auditoria       = array(
            'id'                       => null,
            'ip_realizou_cadastro'     => $ultimaAuditoria->ip_realizou_cadastro,
            'ip_realizou_ultimo_login' => $this->obterIPUsuario(),
            'cadastrado_em'            => $ultimaAuditoria->cadastrado_em,
            'ultimo_acesso_em'         => date('Y-m-d H:i:s'),
            'os'                       => $infoSistema->os,
            'device'                   => $infoSistema->device,
            'browser'                  => $this->obterBrowserUsuario(),
            'id_usuario'               => $usuario->id,
          );
          $this->Auditoria_model->atualizarAuditoria($auditoria);
          $this->session->set_flashdata('successo', 'Logado com sucesso!');
          $this->session->set_userdata('usuario_logado', TRUE);
          $this->session->set_userdata('nome_usuario', $usuario->nome);
          $this->session->set_userdata('ip_usuario', $auditoria['ip_realizou_ultimo_login']);
          redirect('usuario/perfil', 'refresh');
        } else {
          $this->session->set_flashdata('erro', 'Conta inexistente!');
          redirect('auth/login', 'refresh');
        }
      }
    }
    $this->load->view('login');
  }

  public function logout() {
    //$this->session->unset_userdata('variable');
    $this->session->sess_destroy();
    redirect('auth/login', 'refresh');
  }

  public function registro() {
    $registrar = $this->input->post('registro');
    if (isset($registrar)) {
      $this->validarFormularioRegistro();
      $this->customizarMensagensValidacaoFormulario();
      if ($this->form_validation->run() == TRUE) {
        $usuario = array(
          'id'       => null,
          'nome'     => $this->input->post('nome_usuario'),
          'email'    => $this->input->post('email'),
          'senha'    => sha1($this->input->post('senha')),
          'genero'   => $this->input->post('genero'),
          'telefone' => $this->input->post('telefone'),
        );
        $idUsuario   = $this->Auth_model->registrar($usuario);
        $infoSistema = $this->obterSistemaUsuario();
        $auditoria   = array(
          'id'                       => null,
          'ip_realizou_cadastro'     => $this->obterIPUsuario(),
          'ip_realizou_ultimo_login' => $this->obterIPUsuario(),
          'cadastrado_em'            => date('Y-m-d H:i:s'),
          'ultimo_acesso_em'         => date('Y-m-d H:i:s'),
          'os'                       => $infoSistema->os,
          'device'                   => $infoSistema->device,
          'browser'                  => $this->obterBrowserUsuario(),
          'id_usuario'               => $idUsuario,
        );
        $idAuditoria = $this->Auditoria_model->registrar($auditoria);
        $dadosEmail  = array(
          'nome'        => $this->input->post('nome_usuario'),
          'nomeSistema' => 'Sistema Login',
        );
        $conteudoEmail = $this->load->view('templates/emailregistro', $dadosEmail, true);
        $assunto       = 'Login - Bem vindo, seu cadastro foi realizado com sucesso!';
        $this->configurarEmail($conteudoEmail, $this->input->post('email'), $assunto);
        if ($this->email->send()) {
        } else {
          show_error($this->email->print_debugger());
        }
        $this->session->set_flashdata('sucesso', 'Sua conta foi registrada com sucesso!');
        redirect('auth/login', 'refresh');
      }
    }
    $this->load->view('registro');
  }

  public function esqueceuASenha() {
    $esqueceuSenha = $this->input->post('esqueceuasenha');
    if (isset($esqueceuSenha)) {
      $this->validarFormularioEsqueceuSenha();
      $this->customizarMensagensValidacaoFormulario();
      if ($this->form_validation->run() == TRUE) {
        $email       = $this->input->post('email');
        $emailExiste = $this->Auth_model->emailExiste($email);
        if ($emailExiste) {
          $usuario          = $this->Auth_model->buscarUsuarioPorEmail($email);
          $infoSistema      = $this->obterSistemaUsuario();
          $redefinicaoSenha = array(
            'id'                            => null,
            'id_usuario'                    => $usuario->id,
            'requisicao_feita_em'           => date('Y-m-d H:i:s'),
            'email_enviado_em'              => null,
            'url'                           => null,
            'url_expirada'                  => false,
            'ip_solicitou_redefinicao'      => $this->obterIPUsuario(),
            'os_solicitou_redefinicao'      => $infoSistema->os,
            'device_solicitou_redefinicao'  => $infoSistema->device,
            'browser_solicitou_redefinicao' => $this->obterBrowserUsuario(),
            'redefinicao_realizada'         => false,
            'redefinicao_realizada_em'      => null,
            'ip_redefiniu_senha'            => null,
            'os_redefiniu_senha'            => null,
            'device_redefiniu_senha'        => null,
            'browser_redefiniu_senha'       => null,
          );
          $idRedefinicaoSenha = $this->Auth_model->registrarInicioRedefinicaoSenha($redefinicaoSenha);
          $url                = $this->montarUrlRedefinicaoSenha($usuario, $idRedefinicaoSenha);
          $this->Auth_model->registrarUrlRedefinicaoSenha($idRedefinicaoSenha, $url);
          $dadosEmail = array(
            'nome'        => $usuario->nome,
            'link'        => $url,
            'nomeSistema' => 'Sistema Login',
          );
          $conteudoEmail = $this->load->view('templates/emailesqueceuasenha', $dadosEmail, true);
          $assunto       = 'Login - Redefinição de Senha';
          $this->configurarEmail($conteudoEmail, $usuario->email, $assunto);
          if ($this->email->send()) {
            $this->Auth_model->registrarEnvioEmailRedefinicaoSenha($idRedefinicaoSenha, date('Y-m-d H:i:s'));
            $this->session->set_flashdata('sucesso', 'Um email com instruções de redefinição de senha foi enviado a você! Confira seu email.');
            redirect('auth/login', 'refresh');
          } else {
            show_error($this->email->print_debugger());
          }
        } else {
          $this->session->set_flashdata('erro', 'Conta inexistente!');
          redirect('auth/esqueceuASenha', 'refresh');
        }
      }
    }
    $this->load->view('esqueceuasenha');
  }

  public function obterIPUsuario() {
    //OBS: Se o usuario estiver usando mais de um proxy, tunelamento esta funcao ira pegar apenas um proxy.
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
      $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
      $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    } else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
      $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    } else if (isset($_SERVER['HTTP_FORWARDED'])) {
      $ipaddress = $_SERVER['HTTP_FORWARDED'];
    } else if (isset($_SERVER['REMOTE_ADDR'])) {
      $ipaddress = $_SERVER['REMOTE_ADDR'];
    } else {
      $ipaddress = 'UNKNOWN';
    }
    if ($ipaddress == '::1') {
      $ipaddress = '127.0.0.1';
    }

    return $ipaddress;
  }

  public function obterSistemaUsuario() {
    $user_agent  = $_SERVER['HTTP_USER_AGENT'];
    $os_platform = "Unknown OS Platform";
    $os_array    = array(
      '/windows phone 8/i'    => 'Windows Phone 8',
      '/windows phone os 7/i' => 'Windows Phone 7',
      '/windows nt 6.3/i'     => 'Windows 8.1',
      '/windows nt 6.2/i'     => 'Windows 8',
      '/windows nt 6.1/i'     => 'Windows 7',
      '/windows nt 6.0/i'     => 'Windows Vista',
      '/windows nt 5.2/i'     => 'Windows Server 2003/XP x64',
      '/windows nt 5.1/i'     => 'Windows XP',
      '/windows xp/i'         => 'Windows XP',
      '/windows nt 5.0/i'     => 'Windows 2000',
      '/windows me/i'         => 'Windows ME',
      '/win98/i'              => 'Windows 98',
      '/win95/i'              => 'Windows 95',
      '/win16/i'              => 'Windows 3.11',
      '/macintosh|mac os x/i' => 'Mac OS X',
      '/mac_powerpc/i'        => 'Mac OS 9',
      '/linux/i'              => 'Linux',
      '/ubuntu/i'             => 'Ubuntu',
      '/iphone/i'             => 'iPhone',
      '/ipod/i'               => 'iPod',
      '/ipad/i'               => 'iPad',
      '/android/i'            => 'Android',
      '/blackberry/i'         => 'BlackBerry',
      '/webos/i'              => 'Mobile');
    $device = '';
    foreach ($os_array as $regex => $value) {
      if (preg_match($regex, $user_agent)) {
        $os_platform = $value;
        $device      = !preg_match('/(windows|mac|linux|ubuntu)/i', $os_platform)
        ? 'MOBILE' : (preg_match('/phone/i', $os_platform) ? 'MOBILE' : 'SYSTEM');
      }
    }
    $device       = !$device ? 'SYSTEM' : $device;
    $info         = new stdClass();
    $info->os     = $os_platform;
    $info->device = $device;
    return $info;
    //return array('os' => $os_platform, 'device' => $device);
  }

  public function obterBrowserUsuario() {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    $browser = "Unknown Browser";

    $browser_array = array(
      '/msie/i'      => 'Internet Explorer',
      '/firefox/i'   => 'Firefox',
      '/safari/i'    => 'Safari',
      '/chrome/i'    => 'Chrome',
      '/opera/i'     => 'Opera',
      '/netscape/i'  => 'Netscape',
      '/maxthon/i'   => 'Maxthon',
      '/konqueror/i' => 'Konqueror',
      '/mobile/i'    => 'Handheld Browser');

    foreach ($browser_array as $regex => $value) {
      if (preg_match($regex, $user_agent, $result)) {
        $browser = $value;
      }
    }
    return $browser;
  }

  public function configurarEmail($conteudoEmail, $emailUsuario, $assunto) {
    $this->load->library('email');

    $config["protocol"]  = "smtp";
    $config["smtp_host"] = "ssl://smtp.gmail.com";
    $config["smtp_user"] = "";
    $config["smtp_pass"] = "";
    $config["charset"]   = "utf-8";
    $config["mailtype"]  = "html";
    $config["newline"]   = "\r\n";
    $config["smtp_port"] = '465';

    $this->email->initialize($config);
    $this->email->from($config["smtp_user"], $config["smtp_user"]);
    $this->email->to($emailUsuario);
    $this->email->subject($assunto);
    $this->email->message($conteudoEmail);
  }

  public function montarUrlRedefinicaoSenha($infoUsuario, $idRedefinicaoSenha) {
    $token = sha1($infoUsuario->telefone . $infoUsuario->email);
    for ($x = 0; $x <= 3; $x++) {
      $token = sha1($token);
    }
    $idUsuario = $infoUsuario->id;
    $url       = base_url('index.php/redefinirSenha/' . $token . $idUsuario . '/' . $idRedefinicaoSenha);
    return $url;
  }

  public function redefinirSenha() {
    $redefinirsenha = $this->input->post('redefinirsenha');
    if (isset($redefinirsenha)) {
      $this->validarFormularioRedefinicaoSenha();
      $this->customizarMensagensValidacaoFormulario();
      if ($this->form_validation->run() == TRUE) {
        $idUsuario          = $this->input->post('id_usuario');
        $idRedefinicaoSenha = $this->input->post('id_redefinicao_senha');
        $redefinicaoSenha   = $this->Auth_model->buscarRedefinicaoSenhaPorId($idRedefinicaoSenha);
        $infoSistema        = $this->obterSistemaUsuario();
        $redefinicaoSenha   = array(
          'id'                            => $idRedefinicaoSenha,
          'id_usuario'                    => $idUsuario,
          'requisicao_feita_em'           => $redefinicaoSenha->requisicao_feita_em,
          'email_enviado_em'              => $redefinicaoSenha->email_enviado_em,
          'url'                           => $redefinicaoSenha->url,
          'url_expirada'                  => true,
          'ip_solicitou_redefinicao'      => $redefinicaoSenha->ip_solicitou_redefinicao,
          'os_solicitou_redefinicao'      => $redefinicaoSenha->os_solicitou_redefinicao,
          'device_solicitou_redefinicao'  => $redefinicaoSenha->device_solicitou_redefinicao,
          'browser_solicitou_redefinicao' => $redefinicaoSenha->browser_solicitou_redefinicao,
          'redefinicao_realizada'         => true,
          'redefinicao_realizada_em'      => date('Y-m-d H:i:s'),
          'ip_redefiniu_senha'            => $this->obterIPUsuario(),
          'os_redefiniu_senha'            => $infoSistema->os,
          'device_redefiniu_senha'        => $infoSistema->device,
          'browser_redefiniu_senha'       => $this->obterBrowserUsuario(),
        );
        $senha = sha1($this->input->post('senha'));
        $this->Auth_model->redefinirSenha($idUsuario, $senha);
        $this->Auth_model->registrarFinalRedefinicaoSenha($idRedefinicaoSenha, $idUsuario, $redefinicaoSenha);
        $this->session->set_flashdata('sucesso', 'Sua senha foi redefinida com sucesso! Faça o login para acessar sua conta.');
        redirect('auth/login', 'refresh');
      }
    }
    $idUsuario          = substr($this->uri->segment(2), 40);
    $idRedefinicaoSenha = $this->uri->segment(3);
    $redefinicaoExpirou = $this->Auth_model->redefinicaoExpirou($idRedefinicaoSenha, $idUsuario);
    if ($redefinicaoExpirou) {
      $this->load->view('redefinicaoexpirada');
    } else {
      $this->load->view('redefinirSenha');
    }
  }

  public function customizarMensagensValidacaoFormulario() {
    $this->form_validation->set_message('required', 'O campo "%s" é obrigatório.');
    $this->form_validation->set_message('min_length', 'O campo "%s" deve conter no mínimo %d caracteres.');
    $this->form_validation->set_message('max_length', 'O campo "%s" deve conter no máximo %d caracteres.');
    $this->form_validation->set_message('matches', 'O campo "%s" não coincide com "%s".');
    $this->form_validation->set_message('trim', 'O campo "%s" não deve conter espaços.');
    $this->form_validation->set_message('numeric', 'O campo "%s" deve ser um número.');
    $this->form_validation->set_message('valid_email', 'O campo "%s" deve ser um email válido.');
  }

  public function validarFormularioLogin() {
    $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|max_length[255]|valid_email');
    $this->form_validation->set_rules('senha', 'Senha', 'trim|required|min_length[5]|max_length[40]');
  }

  public function validarFormularioEsqueceuSenha() {
    $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|max_length[255]|valid_email');
  }

  public function validarFormularioRedefinicaoSenha() {
    $this->form_validation->set_rules('id_usuario', 'Id Usuario', 'trim|required|min_length[1]|numeric');
    $this->form_validation->set_rules('id_redefinicao_senha', 'Id Redefinição de Senha', 'trim|required|min_length[1]|numeric');
    $this->form_validation->set_rules('senha', 'Senha', 'trim|required|min_length[5]|max_length[40]');
    $this->form_validation->set_rules('confirmacao_senha', 'Confirmação de Senha', 'trim|required|min_length[5]|max_length[40]|matches[senha]');
  }

  public function validarFormularioRegistro() {
    $this->form_validation->set_rules('nome_usuario', 'Nome de Usuário', 'trim|required|min_length[5]|max_length[100]');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|max_length[255]|valid_email');
    $this->form_validation->set_rules('senha', 'Senha', 'trim|required|min_length[5]|max_length[40]');
    $this->form_validation->set_rules('confirmacao_senha', 'Confirmação de Senha', 'trim|required|min_length[5]|max_length[40]|matches[senha]');
    $this->form_validation->set_rules('genero', 'Genero', 'trim|required|min_length[5]|max_length[50]');
    $this->form_validation->set_rules('telefone', 'Telefone', 'trim|required|min_length[5]|max_length[50]');
  }

  public function politicadeprivacidade(){
    $this->load->view('politicadeprivacidade');
  }

  public function termosdeuso(){
    $this->load->view('termosdeuso');
  }

}