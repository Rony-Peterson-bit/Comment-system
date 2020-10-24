<?php
	session_start();
	require_once 'CLASSES/comentarios.php';
	$c = new Comentario("projeto_comentarios","localhost","root","");
	$coments = $c->buscarComentarios();

// Header
include_once 'includes/header.php'; 
?>

	<nav>
		<ul>
			<li><a href="index.php">Inicio</a></li>
			<?php
				if (isset($_SESSION['id_master'])) 
				{ ?>
					<li><a href="dados.php">Dados</a></li>
	<?php		}
				if (isset($_SESSION['id_usuario']) || isset($_SESSION['id_master'])) 
				{ ?>
					<li><a href="sair.php">Sair</a></li>
<?php			}else
				{ ?>
					<li><a href="entrar.php">Entrar</a></li>
<?php			}
			?>
		</ul>
	</nav>
   
	
	<div class="card">
    <div class="card-image waves-effect waves-block waves-light">
      <img class="activator" src="images/office.jpg">
    </div>
    <div class="card-content">
      <span class="card-title activator grey-text text-darken-4">Guia Definitivo Como Criar um Blog Incrível e Ganhar Dinheiro Com Ele<i class="material-icons right">more_vert</i></span>
      <p><a href="#">This is a link</a></p>
    </div>
    <div class="card-reveal">
      <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i>Card Title</span>
      <p>Here is some more information about this product that is only revealed once clicked on.</p>
    </div>
  </div>

	<div id="largura-pagina" >
		<section id="conteudo1">
			<h1>Guia Definitivo Como Criar um Blog Incrível e Ganhar Dinheiro Com Ele</h1>
			
			<p class="texto">É um fato há muito estabelecido que um leitor se distrairá com o conteúdo legível de uma página ao analisar seu layout. O ponto de usar o Lorem Ipsum é que ele tem uma distribuição de letras mais ou menos normal, em vez de usar 'Conteúdo aqui, conteúdo aqui'.</p>
			<p class="texto">1. O ponto de usar o Lorem Ipsum</p>
			<p class="texto">2. È que ele tem uma distribuição de letras</p>
			<p class="texto">3. Lorem Ipsum é que ele tem uma distribuição</p>
			<p class="texto">4. letras mais ou menos normal</p>
			<?php
				if (!isset($_SESSION['id_usuario']))
				{ ?>
					<h2>Comentários</h2>
	<?php		}else
				{ ?>
					<h2>Deixe seu comentários</h2>
	<?php		}
			?>
			

			<?php
				if(isset($_SESSION['id_usuario']) || isset($_SESSION['id_master']))
				{ ?>
					<form method="POST">
						
						<textarea name="texto" placeholder="Participe da discussão" maxlength="400"></textarea>
						<input type="submit" value="PUBLICAR COMENTARIO">
					</form>
<?php			}
			?>


		<?php
			if(count($coments) > 0)//se tiver comentarios no bd
			{
				foreach ($coments as $v) 
				{ ?>
					<div class="area-comentario">
						
						<h3><?php echo $v['nome_pessoa']; ?></h3>
						<h4>
							<?php
								$data = new DateTime($v['dia']);
								echo $data->format('d/m/Y');
								echo " - ";
								echo $v['horario'];
							?>
							<?php
							if (isset($_SESSION['id_usuario'])) 
							{
								//Verificando se comentario realmente é dele
								if ($_SESSION['id_usuario'] == $v['fk_id_usuario']) 
								{ ?>
									<a href="discussao.php?id_exc=<?php echo $v['id'];?>">Excluir</a>
			<?php				}
							}elseif (isset($_SESSION['id_master']))
							{ ?>
								<a href="discussao.php?id_exc=<?php echo $v['id'];?>">Excluir</a>
			<?php			} ?>	
						</h4>
						<p><?php echo $v['comentario'];?></p>
					</div>
	<?php		}
			}else
			{
				echo "Ainda não há comentarios por aqui!";
			}
		?>
		</section>
		<section id="conteudo2">
			<div>
				
				<p>Analisar seu layout. O ponto de usar o Lorem Ipsum é que ele tem uma distribuição de letras mais ou menos normal, em vez de usar 'Conteúdo aqui, conteúdo aqui'.</p>
			</div>
		</section>
		<section id="conteudo3">
			<div>
				<h5>Saiba mais sobre como fazer</h5>
				<p>Analisar seu layout. O ponto de usar o Lorem Ipsum é que ele tem uma distribuição de letras mais ou menos normal, em vez de usar 'Conteúdo aqui, conteúdo aqui'.</p>
			</div>
		</section>
	</div>


<?php
if(isset($_POST['texto']))
{
	$texto = htmlentities(addslashes($_POST['texto']));
	if (isset($_SESSION['id_master']))
	{
		$c->inserirComentario($_SESSION['id_master'], $texto);
	}elseif (isset($_SESSION['id_usuario']))
	{
		$c->inserirComentario($_SESSION['id_usuario'], $texto);
	}
	header("location: discussao.php");
}
?>


<?php
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
	}
	header("location: discussao.php");
}
// Footer
include_once 'includes/footer.php';

?>
