<?php
	session_start();
	require_once 'CLASSES/comentarios.php';
	$c = new Comentario("projet_comentarios","localhost","root","");
	$coments = $c->buscarComentarios();
	if(isset($_POST['texto'])){
		$texto = htmlentities(addslashes($_POST['texto']));
		if (isset($_SESSION['id_master']))
		{
			$c->inserirComentario($_SESSION['id_master'], $texto);
		}elseif (isset($_SESSION['id_usuario']))
		{
			$c->inserirComentario($_SESSION['id_usuario'], $texto);
		}header("location: discussao.php");
	}
	//pegar id de exclusao
	if (isset($_GET['id_exc']))
	{
		$id_e = addslashes($_GET['id_exc']);
	
		if(isset($_SESSION['id_master']))
		{
			$c->excluirComentario($id_e,$_SESSION['id_master']);
	
		}elseif (isset($_SESSION['id_usuario'])) 
		{
			$c->excluirComentario($id_e,$_SESSION['id_usuario']);
		}header("location: discussao.php");} 
// Header
include_once 'includes/header.php '; 
?>

	<nav class="purple lighten-1 black-text " >
		<ul>
			       <li ><a href="index.php " > <i class="material-icons  ">home</i>Inicio </a></li>
	<?php
				if (isset($_SESSION['id_master'])) 
				{ 
	?>
					<li ><a href="dados.php"> <i class="material-icons ">assignment</i>Dados </a></li>
	<?php
	      		}
				if (isset($_SESSION['id_usuario']) || isset($_SESSION['id_master'])) 
				{ 
	?>
					<li><a href="sair.php"><i class="material-icons">close</i> Sair</a></li>
    <?php			
                }else{   ?>
					<li><a href="entrar.php"><i class="material-icons left">account_circle</i> Logar</a></li> <?php			
                }?>
		</ul>
	</nav>
	<div class="container">
	<div class="divider"></div>
		<div class="section">
			<h5>A (velha) internet 1</h5>
			<p>Em 1996, mais de 20 anos atrás, o presidente dos EUA na época, Bill Clinton, editou o Administration’s Telecommunications Act of 1996, organizando a confusão inicial e lançando as diretivas que permitiram entrarmos na era da Internet. Essa regulamentação acreditava que as forças de mercado e a inovação tecnológica eram os motores da moderna internet. Foi um incrível ato de maturidade política, mesmo nos EUA. Seus autores sabiam que alguma coisa impressionante estava para acontecer e o governo prestaria um grande serviço, ficando quieto, deixando a inovação e o investimento privado florescerem.</p>
		</div>
		<div class="divider"></div>
			<div class="section">
				<h5>A nova era</h5>
				<p>Uma nova internet está aparecendo no horizonte. O espectro da Internet das Coisas assombra o mundo. Como todo processo exponencial, ninguém é capaz de prever o que vai realmente acontecer. O IDC prevê um crescimento de 17,5% ao ano. A IHS estima que o mercado de IoT crescerá de 15,4 bilhões de dispositivos conectados em 2015 para 75,4 bilhões em 2025.

				Como há 20 anos, alguma coisa impressionante está novamente acontecendo.

				Em 2010, nascia a Nest Labs com a ideia de um termostato inteligente, conectado à Internet para manter as casas europeias aquecidas no inverno, com o menor consumo de energia. Evoluiu para câmeras conectadas, impressoras conectadas e, de repente, temos 17,5 bilhões de dispositivos conectados hoje em dia.

				As “coisas” conectadas seguem a se multiplicar e enriquecer nossas vidas: eletrodomésticos, dispositivos médicos, automóveis inteligentes, lâmpadas inteligentes, dispositivos vestíveis e todo tipo de equipamento industrial já estão se conectando e apresentando um estimulante cenário para a inovação, para os negócios, para o poder público, gerando novos benefícios para a sociedade.</p>
			</div>
	<div class="divider"></div>
		<div class="section">
			<h5>Internet das Coisas</h5>
			<p>De certa forma, a emergência da IoT hoje apresenta as mesmas características dos primórdios da Internet quando estávamos aprendendo e desenvolvendo novos produtos e serviços que permitiram a explosão de conhecimentos atuais e o aumento brutal dos dados e da produtividade mundial. Eventuais lacunas devem ser trabalhadas, sempre que possível, pelos mecanismos tradicionais de mercado, como auto-regulamentação, contratos padronizados, sempre com foco na competição e na livre-iniciativa.
			A cooperação com entidades internacionais e com outros países para identificar áreas de interesse comum, visando participar da definição de normas, padrões e protocolos abertos, desencorajando, sempre que possível, medidas unilaterais de criação de normas, protocolos, padrões, como, por exemplo, a localização forçada de dados em determinadas áreas geográficas, são bem-vindas e teriam alto potencial para beneficiar as tecnologias emergentes, tal como a IoT made in Brazil.

			Essas medidas poderiam ser fonte de estímulo e fortalecimento do Brasil como exportador de serviços de tecnologia de informação com soluções de IoT escaláveis globalmente.</p>
		</div>
	</div>
  <div class="section">
    <h5>Cibersegurança e Analytics </h5>
    <p>Dois pontos críticos ressaltam nas aplicações de IoT: a Segurança (cyber security) e a Análise (Analytics) estatística de dados e metadados originados nos bilhões de dispositivos conectados, que vai permitir extrair o máximo da IoT.
	Como Cyber Security, Analytics acabou virando um ramo à parte, fortemente informado pelo Big Data, que permite encontrar correlações além daquelas imaginadas pelos formuladores dos modelos estatísticos.
	Ligadas à segurança, mas que devem ser tratados à parte, estão a privacidade e a proteção de dados pessoais. Não existem privacidade e proteção de dados sem uma excelente segurança cibernética. A segurança é condição necessária, porém não suficiente para garantir a privacidade individual.
	Ética Corporativa, Leis, Regulamentações, Governança e Compliance são necessárias para se assegurar a privacidade e proteção dos dados.
	Os formuladores de políticas públicas deveriam encorajar práticas de desenvolvimento seguro de aplicações. A segurança deve estar inserida no projeto, “security by design” ou quando isso não for possível pelo alto custo de desenvolvimento ou pela urgência em se chegar ao mercado, estimular a Auditoria de Segurança do Código das Aplicações, que permite identificar as vulnerabilidades críticas introduzidas no código.
	</p>
  </div>
</div>
	<?php
				if (!isset($_SESSION['id_usuario']))
				{ 
	?>
					<h4 style="color: black;">Comentários</h4>
	<?php		}
	            else
				{ 
	?>
					<h2 style="color: black;">Deixe seu comentários</h2>
	<?php	
	         	}
	?>	
	<?php		
				if(isset($_SESSION['id_usuario']) || isset($_SESSION['id_master'])){ 
	?>
				    
					  <form method="POST">
						<div class="row">
							<div class="input-field col s3">
								
								<textarea id="icon_prefix2" name="texto" maxlength="35" rows="10" style="color: black;">
								</textarea>
								
								<label for="icon_prefix2">Participe da discussão</label>
								
							</div>
						</div>  
								
								<button class="btn waves-effect waves-light purple lighten-1" type="submit" name="action">Submit
									<i class="material-icons right">send</i>
								</button>
					</form>
    <?php		
	}
	?>
	<?php		if(count($coments) > 0)//se tiver comentarios no bd
			{
				foreach ($coments as $v) 
				{ 
    ?>
				<div class="row" >
					<div class="col s12 offset-s">	
						<p><i class="small material-icons">account_box</i><?php echo $v['nome_pessoa']; ?></p>
						<p>
	 <?php
								$data = new DateTime($v['dia']);
								echo $data->format('d/m/Y');
								echo " - ";
								echo $v['horario'];
			
							
							if (isset($_SESSION['id_usuario'])) 
							{
								//Verificando se comentario realmente é dele
								if ($_SESSION['id_usuario'] == $v['fk_id_usuario']) 
								{ 
				?>
									<a href="discussao.php?id_exc=<?php echo $v['id'];?>"> <i class="material-icons">delete_forever</i></a>
									
				<?php			
				                }
							}
							elseif (isset($_SESSION['id_master']))
							{ 
				?>
								<a href="discussao.php?id_exc=<?php echo $v['id'];?>"><i class="material-icons">delete_forever</i></a>
				<?php		
				        	} 
			    ?>	
						</p>
						<p><?php echo $v['comentario'];?></p>
					</div>
				</div>

	<?php	}}else{	echo "Ainda não há comentarios por aqui!";}
		
?>
