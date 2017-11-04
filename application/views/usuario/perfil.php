<?php
$href = base_url();
$this->load->view('templates/header.php'); ?>
<nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
	<div class="container">
		<a class="navbar-brand" href="#">Sistema de Login</a>
		<ul class="nav navbar-nav navbar-right">
			<li class="active">
				<a href="#">Home</a>
			</li>
			<li>
				<a href="<?= $href?>index.php/auth/logout">Sair</a>
			</li>
		</ul>
	</div>
</nav>
<div class="container" style="margin-top: 5%;">
	<section>
		<ol class="breadcrumb">
			<li class="active">
				<a href="#">Home</a>
			</li>
		</ol>
	</section>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Sistema de Login</h3>
		</div>
		<div class="panel-body">
			<h4>Olá, <i><strong><?= $this->session->userdata('nome_usuario'); ?></strong></i></h4>
			<p>Seu IP: <strong><?= $this->session->userdata('ip_usuario'); ?></strong></p>
			<p class="text-justify">
				<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Impedit pariatur, recusandae deleniti omnis libero eaque natus tempore delectus suscipit facilis, neque sequi. Eum, minus iste error, maiores necessitatibus expedita ex.</span>
				<span>Id ratione quas aliquam quaerat suscipit sed, debitis sint totam pariatur ex sapiente ipsum vero, dicta at maiores dolorem quibusdam ea ab accusantium. Laboriosam eos quod veritatis, fugiat sit delectus.</span>
				<span>Delectus similique rem voluptatum, adipisci odit, voluptas mollitia earum totam doloribus consectetur laborum culpa dolores ipsa velit et voluptates animi magnam suscipit doloremque neque eos sit sed repellat est laboriosam.</span>
			</p>
		</div>
	</div>
</div>
<?php $this->load->view('templates/footer.php'); ?>