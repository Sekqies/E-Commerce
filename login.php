<?php 
    ini_set ( 'display_errors' , 1); 
    error_reporting (E_ALL);

    session_start();        

    include("caixa.php");
    
    $conn = coneccao();

    $sql1 = "select * from tbl_usuario order by email ";

    $select = $conn->query($sql1);

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $checa = 0;

    while ($var = $select->fetch() )  
    {
        $varEmail  = $var['email'];
        $varSenha = $var['senha'];
        $varCod = $var['cod_usuario'];

        if($varEmail == $email AND $varSenha != $senha){
            $checa = 1;
        }

        if($varEmail == $email AND $varSenha == $senha){
            $checa = 2;
            $varEmail = $var['email'];
            $varSenha = $var['senha'];
        }

        if($checa == 0){
            echo "html com caixa q NAO tem conta......";
            header('Location: cadastro.html');
        }
        
        if($checa == 1){
            echo "html com caixa senha incorreta";
            header('Location: login.html');
        }
    
        if($checa == 2){
    
            
            Cookie('login', $varCod, 1440);
            /*sessao($varCod);*/
            /*$true = true;*/
            $_SESSION['conectado'] = sessao($cod);

            echo "Caixa com confirmacao de login......";
            sleep(1);
            header('Location: login.html');   
        }
    }

    
      

?>
