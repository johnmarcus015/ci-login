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
				<section class="col-md-7">
					<div class="panel-body">
						<legend>Sobre</legend>
						<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
							<!-- Indicators -->
							<ol class="carousel-indicators">
								<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
								<li data-target="#carousel-example-generic" data-slide-to="1"></li>
							</ol>
							<!-- Wrapper for slides -->
							<div class="carousel-inner" role="listbox">
								<div class="item active">
									<p class="text-justify">
										<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque maiores facilis facere molestiae fugit repellendus. Veritatis, aut consequuntur ex neque quo, et facere provident placeat animi reprehenderit, aperiam, reiciendis sequi.</span>
										<span>Repellendus maiores nam atque inventore architecto at odio labore reiciendis, aperiam eligendi. Nulla nesciunt quisquam eum unde veritatis amet impedit distinctio, qui, facilis iure sapiente maxime perferendis, totam asperiores sequi?</span>
										<span>Incidunt dolor quidem voluptatibus ullam, aliquid veritatis dignissimos eius officia corporis explicabo laudantium atque laboriosam optio obcaecati perferendis nobis eligendi est doloremque quae earum non? Tenetur earum aliquid, fuga quasi.</span>
									</p>
								</div>
								<div class="item">
									<p class="text-justify">
										<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque maiores facilis facere molestiae fugit repellendus. Veritatis, aut consequuntur ex neque quo, et facere provident placeat animi reprehenderit, aperiam, reiciendis sequi.</span>
										<span>Repellendus maiores nam atque inventore architecto at odio labore reiciendis, aperiam eligendi. Nulla nesciunt quisquam eum unde veritatis amet impedit distinctio, qui, facilis iure sapiente maxime perferendis, totam asperiores sequi?</span>
										<span>Incidunt dolor quidem voluptatibus ullam, aliquid veritatis dignissimos eius officia corporis explicabo laudantium atque laboriosam optio obcaecati perferendis nobis eligendi est doloremque quae earum non? Tenetur earum aliquid, fuga quasi.</span>
									</p>
								</div>
							</div>
						</div>
					</div>
				</section>
				<section class="col-md-5" id="login">
					<div class="panel-login">
						<div class="content-login">
							<form action="" method="POST" role="form" id="form-login">
								<legend>
									Login
								</legend>
								<p>Preencha os campos para acessar o sistema</p>
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
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="">
												E-mail (*)
											</label>
											<input class="form-control" id="email" value="<?=set_value('email');?>" name="email" placeholder="E-mail" type="email"/>
										</div>
										<div class="form-group">
											<label for="">
												Senha (*)
											</label>
											<input class="form-control" id="senha" value="<?=set_value('senha');?>" name="senha" placeholder="Senha" type="password"/>
										</div>
										<div class="form-group">
											<label for="" class=" pull-left">
												<span>
													<a href="<?=$href;?>index.php/auth/esqueceuASenha">Esqueceu sua senha?</a>
												</span>
											</label>
										</div>
										<div class="form-group">
											<label class="pull-right">
												<span>
													Não tem uma conta?
													<a href="<?=$href;?>index.php/auth/registro">
														Increva-se
													</a>
												</span>
											</label>
										</div>
									</div>
								</div>
								<button class="btn btn-primary" type="submit" name="login">
								Entrar
								</button>
							</form>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>
</section>
<script src="<?=$href;?>assets/dist/js/third_party/particles.js"></script>
<script src="<?=$href;?>assets/dist/js/validar-formulario-login.js"></script>
<script>
particlesJS.load('particles-js', '<?=$href;?>assets/dist/js/third_party/particlesjs-config.json', function() {
});
</script>
<?php $this->
load->view('templates/footer.php');?>