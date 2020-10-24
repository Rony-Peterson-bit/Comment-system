<?php 
 // Header
include_once 'includes/header.php';
?>
	<h1 style="text-align: center;">Acesse a sua conta</h1>
	<div class="row">
	<form method="POST" class="col s12 m12 l12">
		<div class="row">

		   <div class="input-field col s4 offset-s4">
			 <i class="material-icons prefix">local_post_office</i>
			 <input id="email" type="email" name="email" autocomplete="off" maxlength="40"class="validate" >
			 <label for="email" data-error="wrong" data-success="right">Email</label>
		   </div>
		   
		   <div class="input-field col s4  offset-s4  ">
		      <i class="material-icons prefix">lock</i>
			  <input type="password" name="senha">
			  <label for="icon_telephone">Senha</label> 
		   </div>

		   <div class="input-field col s4  offset-s5  ">
		  	 <button class="btn waves-effect waves-light" type="submit" 			name="action">Entrar
   			 <i class="material-icons right">send</i>
  			</button>
		   </div>

		   <div class="input-field col s4  offset-s5  ">
			   <a href="cadastrar.php">Registre-se agora!</a>
			   <a href="cadastrar.php" class="btn btn-floating btn-small cyan pulse"><i class="small material-icons">edit</i></a>

			   

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
			?><h1 style="text-align: center;">Email e/ou senha estão incorretos!</h1><?php
		}
	}else
	{
	   ?>	<h1 style="text-align: center;">Preencha todos os campos! </h1> 
	   <?php
	}
}

// Footer
include_once 'includes/footer.php';

?>