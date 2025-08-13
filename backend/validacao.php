<?php
    session_start();

    //se não estiver logado, mandar para o login
    //se não existir a variável de sessão cpf ou senha

    if(!isset($_SESSION['cpf']) or !isset($_SESSION['senha'])) {
        //destruir a sessão
        session_destroy();
        unset($_SESSION['cpf']);
        unset($_SESSION['senha']);

        //manda para o login
        header('location:./index.php');
    }
?>        
