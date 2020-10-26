<?php
	require_once 'CLASSES/usuarios.php';
	session_start();
	if(isset($_SESSION['id_usuario']))
	{
		$us = new Usuario("projeto_comentarios","localhost","root","");
		$informacoes = $us->buscarDadosUser($_SESSION['id_usuario']);
	}elseif(isset($_SESSION['id_master']))
	{
		$us = new Usuario("projeto_comentarios","localhost","root","");
		$informacoes = $us->buscarDadosUser($_SESSION['id_master']);
	}
	// Header
    include_once 'includes/header.php';
?>
    
	<nav  >
	  <div class="nav-wrapper purple lighten-1">
		   <ul  class="right hide-on-med-and-down" >

				<?php
					if(isset($_SESSION['id_master']))
					{ ?>
						<li ><a href="dados.php"> <i class="material-icons">assignment</i>Dados </a></li>
		<?php		}
				?>
				<li><a href="discussao.php"><i class="material-icons">chat_bubble_outline</i> Discussão</a></li>
				<?php
					if(isset($informacoes))//tem uma sessao, tem uma pessoa logada
					{ ?>
						<li><a href="sair.php"><i class="material-icons">close</i> Sair</a></li>
		<?php		}
					else
					{ ?>
						<li><a href="entrar.php"><i class="material-icons left">account_circle</i> Logar</a></li>
		<?php		}
				?>		
			</ul>
	  </div>
	</nav>
	
	<?php
	 if (isset($_SESSION['id_master']) || isset($_SESSION['id_usuario']))
	 { ?>
		<h2 style="text-align: center;">
			<?php 
			echo "Olá! "; 
			echo $informacoes['nome'];
			echo " ,seja bem vindo(a)!";
			?>
		</h2>
<?php }
?>
	<h3 style="text-align: center;">TELA INICIAL</h3>
	
       <img src="assets/img/Capturar.PNG" alt="">
	

<?php
// Footer
include_once 'includes/footer.php';
?>