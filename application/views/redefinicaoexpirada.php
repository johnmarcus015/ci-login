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
.carousel-indicators{
margin-bottom: -50px;
}
.carousel-indicators>li{
background-color: #aaa;
}
.carousel-indicators>li.active{
background-color: #555;
}
</style>
<script src="<?=$href;?>assets/dist/js/third_party/particles.js"></script>
<script>
particlesJS.load('particles-js', '<?=$href;?>assets/dist/js/third_party/particlesjs-config.json', function() {
console.log('callback - particles.js config loaded');
});
</script>
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
				<section class="col-md-10" id="login">
					<div class="panel-login">
						<div class="content-login">
							<legend class="text-default">
								Ops!
							</legend>
							<label>
								<span class="text-danger">
									Esse link para redefinição de senha já foi utilizado e expirou!
								</span>
							</label>
							<p>
								Caso você precise de um novo link para redefinição de senha, acesse a página de login e solicite outro na opção <i><strong>esqueceu a senha</strong></i>.
							</p>
							<a href="<?=$href;?>index.php/auth/login" class="btn btn-default">Ir para Login</a>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>
</section>
<?php $this->load->view('templates/footer.php');?>