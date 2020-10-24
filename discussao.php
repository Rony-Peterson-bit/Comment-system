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


  

	
			<?php
				if (!isset($_SESSION['id_usuario']))
				{ ?>
					<h4>Comentários</h4>
	<?php		}else
				{ ?>
					<h2>Deixe seu comentários</h2>
	<?php		}
			?>
			

			<?php
				if(isset($_SESSION['id_usuario']) || isset($_SESSION['id_master']))
				{ ?>
				    <div class="row">
					  <form method="POST">
						<div class="row">
						 <div class="input-field col s3">
						  <i class="material-icons prefix">mode_edit</i>
						  <textarea id="icon_prefix2" name="texto" placeholder="Participe da discussão" maxlength="400"></textarea>
						  <label for="icon_prefix2">First Name</label>
				</div>
				</div>
						<input type="submit" value="PUBLICAR COMENTARIO">
					</form>
					</div>
<?php			}
			?>


		<?php
			if(count($coments) > 0)//se tiver comentarios no bd
			{
				foreach ($coments as $v) 
				{ ?>
					<div class="area-comentario" class="">
						
						<h4><?php echo $v['nome_pessoa']; ?></h4>
						<p>
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
						</p>
						<p><?php echo $v['comentario'];?></p>
					</div>
	<?php		}
			}else
			{
				echo "Ainda não há comentarios por aqui!";
			}
		?>
		
	
		
			
	


		
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
