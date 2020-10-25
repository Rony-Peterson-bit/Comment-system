<?php 

class Usuario{
    private $pdo;
    //--------------------------------------construtor-------------------------------------------------------
    public function __construct($dbname, $host, $usuario, $senha)
    {
        try {
            $this->pdo= new PDO("mysql:dbname=".$dbname.";host=".$host,$usuario,$senha);
        } 
        catch (PDOException $e) 
       
        {
            echo "Erro com BD: ".$e->getMessage();
        }
        catch(Exception $e)
        {
            echo "Erro: ".$e->getMessage();        
        }
    }

// Cadastrar
public function cadastrar($nome, $email, $senha) 
{
    //Antes de cadastrar verificar se email ja está cadastrado
    $cmd=$this->pdo->prepare("SELECT id from usuarios WHERE email=:e");
    $cmd->bindValue(":e",$email);
    $cmd->execute();
    if($cmd->rowCount()>0)//veio id
    {
        return false;
    }
    else//não veio id
    {
      //cadastrar
    $cmd =$this->pdo->prepare("INSERT INTO usuarios (nome,email,senha) values(:n, :e, :s)");
    $cmd->bindValue(":n",$nome);
    $cmd->bindValue(":e",$email);
    $cmd->bindValue(":s",md5($senha)); 
    $cmd->execute();
    return true;
    }
}
//Logar
public function entrar($email, $senha)
{
    $cmd =$this->pdo->prepare("SELECT* from usuarios WHERE email = :e AND senha = :s");
    $cmd->bindValue(":e",$email);
    $cmd->bindValue(":s",md5($senha));
    $cmd->execute();
    //Verificar se email e senha retornaram
    if($cmd->rowCount() > 0)//Se foi encontrado
    {
        $dados = $cmd->fetch();//fetch() para informação virar array
        session_start();//abrindo cessão
        if($dados['id'] == 1) //verificar se id =1 pq é o adm
        {
            //usuario adm
            $_SESSION['id_master']=1;// se for administrador terá uma sessão chamada id_master'
        }
        
        else 
        {
            //usuario normal
            $_SESSION['id_usuario']= $dados['id'];
        }
        return true;
        
    }
    else
    {
        return false;
    }
}

public function buscarDadosUser($id)
{
    $cmd = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
    $cmd->bindValue(":id",$id);
    $cmd->execute();
    $dads= $cmd->fetch();//tranformar em array
    return $dads;
    
}

}


?>