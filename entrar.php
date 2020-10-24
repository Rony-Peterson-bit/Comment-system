<?php 
 // Header
include_once 'includes/header.php';
?>
	<h1>Acesse a sua conta</h1>
	<div class="row">
	<form method="POST" class="col s12 m12 l12">
		<div class="row">
		   <div class="input-field col s4 offset-s4">
			 <i class="material-icons prefix">account_circle</i>
			 <input type="email" name="email" autocomplete="off" maxlength="40">
			 <label for="icon_prefix">Email</label>
		   </div>
		   
		   <div class="input-field col s4  offset-s4  ">
		      <i class="material-icons prefix">phone</i>
			  <input type="password" name="senha">
			  <label for="icon_telephone">Senha</label> 
		   </div>

		   <div class="input-field col s4  offset-s5  ">
				<input type="submit" value="ENTRAR">
				<a href="cadastrar.php">Registre-se agora!</a>
		   </div>
		
		</div>
		
	</form>
	</div>


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