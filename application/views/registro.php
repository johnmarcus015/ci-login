<?php
$href = base_url();
$this->load->view('templates/header.php');?>
<style>
#panel-registro {
height: <?php if (validation_errors()): echo '75%';else:echo '75%';endif;?>
}
section.container{
position:absolute;
margin-right: auto;
margin-left: auto;
left: 0;
right: 0;
top: 10%
}
</style>
<div id="particles-js"></div>
<nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
  <div class="container">
    <a class="navbar-brand" href="#">Sistema de Login</a>
    <ul class="nav navbar-nav navbar-right">
      <li class="active">
        <a href="#">Login</a>
      </li>
    </ul>
  </div>
</nav>
<section class="container">
  <div class="panel panel-default" id="panel-registro">
    <div class="panel-body">
      <form action="" method="POST" role="form" id="form-registro">
        <legend>
          Registre-se
        </legend>
        <p>Preencha os campos para registrar-se</p>
        <?php if ($this->session->flashdata('sucesso')): ?>
        <div class="text text-success"><?=$this->session->flashdata('sucesso');?></div>
        <?php endif;?>
        <?php if (validation_errors()): ?>
        <div class="alert alert-danger">
          <ul>
            <?php echo validation_errors('<li class="text-danger">', '</li>'); ?>
          </ul>
        </div>
        <?php endif;?>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="nome_usuario" class="control-label">
                Nome (*)
              </label>
              <input class="form-control" id="nome_usuario" value="<?=set_value('nome_usuario');?>" name="nome_usuario" placeholder="Nome" type="text" required/>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group ">
              <label for="email" class="control-label">
                E-mail (*)
              </label>
              <input class="form-control" id="email" value="<?=set_value('email');?>" name="email" placeholder="E-mail" type="email" required/>
            </div>
            <div class="form-group ">
              <label for="senha" class="control-label">
                Senha (*)
              </label>
              <input class="form-control" id="senha" value="<?=set_value('senha');?>" name="senha" placeholder="Senha" type="password" required/>
            </div>
            <div class="form-group ">
              <label for="confirmacao_senha" class="control-label">
                Confirmação de Senha (*)
              </label>
              <input class="form-control" id="confirmacao_senha" value="<?=set_value('confirmacao_senha');?>" name="confirmacao_senha" placeholder="Confirmação de Senha" type="password" data-match="#senha" data-match-erro="As senhas não coincidem!" required/>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group ">
              <label for="genero" class="control-label">
                Genero (*)
              </label>
              <select class="form-control" id="genero" value="<?=set_value('genero');?>" name="genero">
                <option value="Masculino">
                  Masculino
                </option>
                <option value="Feminino">
                  Feminino
                </option>
              </select>
            </div>
            <div class="form-group">
              <label for="telefone" class="control-label">
                Celular (*)
              </label>
              <input class="form-control" id="telefone" value="<?=set_value('telefone');?>" name="telefone" placeholder="Celular" type="phone" required/>
            </div>
            <div class="form-group">
              <label for="captcha" class="control-label" id="captcha_operacao"></label>
              <input type="number" class="form-control" id="captcha" name="captcha_operacao" placeholder="Ex: 99" />
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group has-feedback">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="termos_e_condicoes" value="termos_e_condicoes" />Ao clicar em registrar você concorda com os <a href="<?=$href;?>index.php/auth/termosdeuso" target="_blank">Termos de Uso</a> e que leu nossa <a href="<?=$href;?>index.php/auth/politicadeprivacidade" target="_blank">Política de Privacidade</a>.
                </label>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <button class="btn btn-primary" type="submit" name="registro">
            Registrar
            </button>
            <a href="<?=$href;?>index.php/auth/login" class="btn btn-default">Ir para Login</a>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
</section>
<script src="<?=$href;?>assets/dist/js/third_party/particles.js"></script>
<script src="<?=$href;?>assets/dist/js/validar-formulario-registro.js"></script>
<script>
particlesJS.load('particles-js', '<?=$href;?>assets/dist/js/third_party/particlesjs-config.json', function() {
});
</script>
<?php $this->load->view('templates/footer.php');?>