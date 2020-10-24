<?php
session_start();
if (!isset($_SESSION['id_master']))
{
	header("location: index.php");
}
require_once 'CLASSES/usuarios.php';
$us = new Usuario("projeto_comentarios","localhost","root","");
$dados = $us->buscarTodosUsuarios();

 // Header
 include_once 'includes/header.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Sistema de Comentarios</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="CSS/dados.css"/>
</head>
<body>
	<nav>
		<ul>
			<li><a href="index.php">Inicio</a></li>
			<li><a href="discussao.php">Discussão</a></li>
			<li><a href="sair.php">Sair</a></li>
		</ul>
	</nav>

	
	<table  class="centered">
		<thead>
			<tr id="titulo">
				<th>ID</th>
				<th>NOME</th>
				<th>EMAIL</th>
				<th>COMENTÁRIOS</th>
			</tr>
	</thead>

	<tbody>
		<?php
		if(count($dados) > 0)
		{
			foreach ($dados as $v) 
			{ ?>
				<tr>
					<td><?php echo $v['id'];?></td>
					<td><?php echo $v['nome'];?></td>
					<td><?php echo $v['email'];?></td>
					<td><?php echo $v['quantidade'];?></td>
				</tr>
					
	<?php	}
		}else
		{
			echo "Ainda não há usuarios cadastrados";
		}

		// Footer
	include_once 'includes/footer.php';
		?>
		</tbody>
	</table>
