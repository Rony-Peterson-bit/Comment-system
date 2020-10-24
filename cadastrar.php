<?php 
  // Header
include_once 'includes/header.php';
?>
	<h1 style="text-align: center;">CADASTRE-SE</h1>
	
	<div class="row">
		<form method="POST" class="col s12 m12 l12">
			<div class="row">

			<div class="input-field col s4  offset-s4  ">
			  <input type="text" name="nome" id="nome" maxlength="40" autocomplete="off" >
			  <label for="nome">NOME</label>
		   </div>
			
			
			

			<div class="input-field col s4 offset-s4">
			 <input id="email" type="email" name="email" autocomplete="off" maxlength="40"class="validate" >
			 <label for="email" data-error="wrong" data-success="right">Email</label>
		   </div>

		   <div class="input-field col s4  offset-s4  ">
			  <input type="password" name="senha">
			  <label for="senha">Senha</label> 
		   </div>
 

           <div class="input-field col s4  offset-s4  ">
			  <input type="password" name="confSenha" id="confSenha">
			  <label for="confSenha">Confirmar Senha</label>
		   </div>

		   <div class="input-field col s4  offset-s5  ">
		  	 <button class="btn waves-effect waves-light" type="submit" 			name="action">Cadastrar
   			 <i class="material-icons right">send</i>
  			</button>
		   </div>
		</form>
		</div>
	</div>

<!--========================== PHP ==========================-->

<?PHP
// 1 - VERIFICAR SE ELA APERTOU O BOTAO CADASTRAR - ok
// 2 - GUARDAR DADOS DENTRO DE VARIAVEIS e verificar se esta vazia - ok
// 3 - ENVIAR DADOS COLHIDOS PARA A CLASSE , FUNCAO CADASTRAR
// 4 - VERIFICAR O RETORNO FALSE OU TRUE

if(isset($_POST['nome']))
{

	$nome = addslashes($_POST['nome']);
	$email = addslashes($_POST['email']);
	$senha = addslashes($_POST['senha']);
	$confSenha = addslashes($_POST['confSenha']);

	if(!empty($nome) && !empty($email) && !empty($senha) && !empty($confSenha))
	{
		if($senha == $confSenha)
		{
			require_once 'CLASSES/usuarios.php';
			$us = new Usuario("projeto_comentarios","localhost","root","");
			if($us->cadastrar($nome, $email, $senha))
			{ ?>
				<p style="text-align: center;"class="mensagem">Cadastrado com sucesso!<a href="entrar.php">Acesse já!</a></p> 
<?php		}else
			{ ?>
				<p style="text-align: center;"class="mensagem">Email já está cadastrado!</p>
<?php		}
		}else
		{ ?>
			<p style="text-align: center;" class="mensagem">Senhas não correspondem!</p>
<?php	}	
	}else
	{ ?>
		<p style="text-align: center;"class="mensagem">Preencha todos os campos!</p>
<?php }
}

// Footer
include_once 'includes/footer.php';
?>