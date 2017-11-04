<?php
$href = base_url();
$this->load->view('templates/header.php');?>
<style>
#panel-login {
height: <?php if (validation_errors() || $this->session->flashdata('erro')): echo '60%';else:echo '48%';endif;?>;
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
	<div class="row" >
		<div class="panel panel-default" id="panel-login">
			<div class="panel-body">
				<section class="col-md-5" id="login">
					<div class="panel-login">
						<div class="content-login">
							<form action="" method="POST" role="form" id="form-redefinicao-senha">
								<legend>
									Redefinição de Senha
								</legend>
								<p>Preencha os campos para redefinir a sua senha de acesso</p>
								<?php if ($this->session->flashdata('sucesso')): ?>
								<div class="alert alert-success"><?=$this->session->flashdata('sucesso');?></div>
								<?php elseif ($this->session->flashdata('erro')): ?>
								<div class="alert alert-danger"><?=$this->session->flashdata('erro');?></div>
								<?php endif;?>
								<?php if (validation_errors()): ?>
								<div class="alert alert-danger">
									<ul>
										<?php echo validation_errors('<li class="text-danger">', '</li>'); ?>
									</ul>
								</div>
								<?php endif;?>
								<div class="form-group">
								<input type="hidden" name="id_usuario" value="<?= substr($this->uri->segment(2), 40); ?>">
								<input type="hidden" name="id_redefinicao_senha" value="<?= $this->uri->segment(3); ?>">
									<label for="">
										Senha (*)
									</label>
									<input class="form-control" id="senha" value="<?=set_value('senha');?>" name="senha" placeholder="Senha" type="password"/>
									<label for="">
										Confirmação de Senha (*)
									</label>
									<input class="form-control" id="confirmacao_senha" value="<?=set_value('confirmacao_senha');?>" name="confirmacao_senha" placeholder="Confirmação de Senha" type="password"/>
								</div>
								<div class="row">
									<div class="col-md-2">
										<button class="btn btn-primary" type="submit" name="redefinirsenha">
										Redefinir
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>
</section>
<script src="<?=$href;?>assets/dist/js/validar-formulario-redefinicao-senha.js"></script>
<script src="<?=$href;?>assets/dist/js/third_party/particles.js"></script>
<script>
particlesJS.load('particles-js', '<?=$href;?>assets/dist/js/third_party/particlesjs-config.json', function() {
});
</script>
<?php $this->load->view('templates/footer.php');?>