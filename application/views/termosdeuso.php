<?php
$href = base_url();
$this->load->view('templates/header.php');?>
<style>
section.container{
position:absolute;
margin-right: auto;
margin-left: auto;
left: 0;
right: 0;
top: 10%
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
				<section class="col-md-12" id="politica_privacidade">
					<div class="panel-login">
						<legend>
							Termos de Uso
						</legend>
						<h5>SEÇÃO 1 - O QUE FAREMOS COM ESTA INFORMAÇÃO?</h5>
						<p>
							<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque, amet. Quo ut vel dolorum quod quidem, veritatis exercitationem, nesciunt quibusdam voluptatem sed iure, accusantium repellat debitis voluptates delectus sit. Quod.</span>
							<span>Perspiciatis magni quos, eligendi pariatur officiis temporibus illum, repellat laborum, sed voluptatem aliquid nihil veritatis illo aliquam mollitia accusamus nemo excepturi totam beatae eum modi odio ducimus placeat itaque. In.</span>
							<span>Cum omnis totam aperiam minima exercitationem possimus maiores, laboriosam quia obcaecati facilis! Dolorem distinctio quam, sit, quidem dolorum quas, nostrum officiis aspernatur similique atque cumque rem aut perferendis pariatur et!</span>
						</p>
						<h5>SEÇÃO 2 - CONSENTIMENTO</h5>
						<h5>Como vocês obtêm meu consentimento?</h5>
						<p>
							<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat dolores, consequatur eos? Ipsa corporis, dolorem quo voluptatibus, magnam laborum. Nemo saepe fuga recusandae praesentium aspernatur sit quia, non facilis expedita!</span><span>Provident ullam laborum consectetur mollitia cum ex sequi magni dicta et voluptatibus deleniti fuga minus debitis, inventore consequatur! Ipsam nihil in deserunt obcaecati dignissimos soluta! Corrupti incidunt voluptatibus blanditiis suscipit?</span>
						</p>
						<h5>E caso você queira retirar seu consentimento, como proceder?</h5>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum aut velit veniam nulla ipsum vitae praesentium. Asperiores enim, harum esse. Perferendis voluptatum incidunt ipsam inventore, quod odit ab deserunt nihil.</p>
						<h5>SEÇÃO 3 - DIVULGAÇÃO</h5>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni odit perferendis laboriosam quis consequuntur libero, esse, omnis vel molestias accusantium saepe, doloremque vero quia repellat animi laborum minus, fugit neque!
						</p>
						<h5>SEÇÃO 4 - SERVIÇOS DE TERCEIROS</h5>
						<p>
							<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam asperiores iure, repellat mollitia cumque molestias corporis ea soluta earum esse assumenda nulla, amet vel nobis, impedit saepe non quo autem.</span>
							<span>Accusamus corporis obcaecati, laboriosam distinctio quisquam voluptatibus voluptas tempora nostrum est facilis neque non repellendus reiciendis voluptatum earum labore in reprehenderit ducimus inventore odit architecto iusto recusandae nisi, ab. Laboriosam!</span>
							<span>Vel consectetur, eaque praesentium dolores ipsum corporis totam error incidunt enim officia delectus? Fugit sapiente incidunt consequuntur optio, dolorum necessitatibus repudiandae eaque quos fugiat eum fuga sequi temporibus ducimus nam!</span>
							<span>Veritatis maiores dicta quas quaerat, qui consectetur! Illum beatae odit enim, iste iusto inventore consectetur doloribus ullam eius ipsum accusantium totam veritatis aspernatur id itaque voluptates molestias unde dolore laudantium.</span>
							<span>Fugit ut non nihil totam eum alias, quod blanditiis praesentium incidunt dolorem illum sapiente culpa repellat sunt beatae quam velit eius est dignissimos omnis, enim! Iste possimus vel hic distinctio.</span>
						</p>
						<h5>Links</h5>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate debitis odio amet iusto! Blanditiis quasi amet, quidem doloribus iusto eos eveniet, dolore beatae odio labore illo. Magnam, molestias delectus accusantium?
						</p>
						<h5>SEÇÃO 5 - SEGURANÇA</h5>
						<p>
							<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde ab quis molestiae dolor blanditiis, nulla assumenda eos quasi repudiandae, sapiente quo natus modi, facere. Facere iure, aliquid quas tenetur aperiam!</span><span>Ullam, doloribus vel corrupti natus eligendi quidem excepturi consectetur. Laudantium omnis sit quisquam, ipsam dolore iure ipsa voluptas non aspernatur, repellendus voluptatum doloribus quos rem nisi consequatur qui, similique nulla.</span>
						</p>
						<h5>SEÇÃO 6 - ALTERAÇÕES PARA ESSA POLÍTICA DE PRIVACIDADE</h5>
						<p>
							<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur delectus fuga fugit ad, sequi nemo asperiores eveniet voluptatum molestiae ea assumenda distinctio excepturi nostrum odio ipsam aliquid atque deleniti quo.</span><span>Alias praesentium voluptatum consectetur, voluptatem, animi maiores iusto accusantium porro cumque saepe debitis repudiandae magnam. Eum tempore nihil assumenda, saepe explicabo magnam. Quasi, voluptas, commodi. Eligendi, iure eius labore recusandae!</span>
						</p>
					</div>
				</section>
			</div>
			<div class="panel-footer">
				<a href="<?=$href;?>index.php/auth/login" class="btn btn-default">Ir para Login</a>
			</div>
		</div>
	</div>
</section>
<?php $this->
load->view('templates/footer.php');?>