<?php
	session_start();
	require_once 'CLASSES/comentarios.php';
	$c = new Comentario("projet_comentarios","localhost","root","");
	$coments = $c->buscarComentarios();

// Header
include_once 'includes/header.php'; 
?>

	<nav class="purple lighten-1">
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

       <div  style=" height: 480px;width: 50%; ">
       <img src="assets/img/Capturar.PNG" alt="">
       </div>  
	
			<?php
				if (!isset($_SESSION['id_usuario']))
				{ ?>
					<h4 style="color: white;">Comentários</h4>
	<?php		}else
				{ ?>
					<h2 style="color: white;">Deixe seu comentários</h2>
	<?php		}
			?>
			

			<?php
				if(isset($_SESSION['id_usuario']) || isset($_SESSION['id_master']))
				{ ?>
				    
					  <form method="POST">
						<div class="row">
						 <div class="input-field col s3">
						 
						  <textarea id="icon_prefix2" name="texto" maxlength="35" rows="10" style="color: white;">
						</textarea>
						  
						  <label for="icon_prefix2">Participe da discussão</label>
						  
				</div>
				</div>  
				
						<input type="submit" value="PUBLICAR COMENTARIO">
					</form>
					
					
<?php		
	}
			
			if(count($coments) > 0)//se tiver comentarios no bd
			{
				foreach ($coments as $v) 
				{ ?>
				<div class="row" >
					<div class="col s12 offset-s">	
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
			<?php			} 
			?>	
						</p>
						<p><?php echo $v['comentario'];?></p>
						</div>
	</div>
					
	<?php		}
			}else
			{
				echo "Ainda não há comentarios por aqui!";
			}
			// Footer 
			include_once 'includes/footer.php';
		?>
		


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
?>
