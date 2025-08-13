<?php

session_start();
//destruir a seção
session_destroy();

//limpar as variaveis de senaçao
unset($_SESSION['cpf']);
unset($_SESSION['senha']);

//manda para o login 
header('location:../index.php');

?>