<?php
    include 'conexao.php';
    //recebeer o cpf e senha do formulario de login por requisição
    $cpf = $_REQUEST['cpf'];
    $senha = $_REQUEST['senha'];

    //
    $sql = "SELECT * FROM usuario WHERE cpf='$cpf' AND senha='$senha' ";

    //executar sql
    $resultado = mysqli_query($conexao, $sql);
    //cada valor dos resultados é associado oa nome da colluna no banco
    $coluna = mysqli_fetch_assoc($resultado);

    echo $coluna['nome'];
    
    if(mysqli_num_rows($resultado) > 0){
                session_start(); //iniciar a sessão

        //criar variáveis de sessão
        $_SESSION['usuario'] = $coluna['nome'];
        $_SESSION['cpf'] = $coluna['cpf'];
        $_SESSION['senha'] = $coluna['senha'];

        header('location:../principal.php');
     } else{
       header('location:../index.php?erro=1');
    }
    
    
?>