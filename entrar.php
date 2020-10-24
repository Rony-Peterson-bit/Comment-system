<?php 
 // Header
include_once 'includes/header.php';
?>
	
	<form method="POST">
		<h1>Acesse a sua conta</h1>
		
		<input type="email" name="email" autocomplete="off" maxlength="40">
		
		<input type="password" name="senha">
		<input type="submit" value="ENTRAR">
		<a href="cadastrar.php">Registre-se agora!</a>
	</form>


<?php

if(isset($_POST['email']))
{
	$email = addslashes($_POST['email']);
	$senha = addslashes($_POST['senha']);
	if(!empty($email) && !empty($senha))
	{
		require_once 'CLASSES/usuarios.php';
		$us = new Usuario("projeto_comentarios","localhost","root","");
		if($us->entrar($email, $senha))
		{
			header("location: index.php");
		}else
		{
			?><h1>Email e/ou senha estão incorretos!</h1><?php
		}
	}else
	{
	   ?>	<h1>Preencha todos os campos! </h1> 
	   <?php
	}
}

// Footer
include_once 'includes/footer.php';

?>