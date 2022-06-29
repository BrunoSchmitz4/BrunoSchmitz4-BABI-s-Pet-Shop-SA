<?php

session_start();
unset($_SESSION['id'], $_SESSION['nome'], $_SESSION['email'], $_SESSION['senha'], $_SESSION['nivel_acesso_id']);

$_SESSION['msg'] = "Deslogado com sucesso!";
header("Location:../index.php");
 
//$_SESSION['msg'] =  password_hash(123456,PASSWORD_DEFAULT);

// clientelogged, admin, colaborador 
// if(!empty($_SESSION['id'])){

// } else{
//     $_SESSION['msg'] = "Página Restrita";
// }

// session_unset();
// session_destroy();
// header("Location:../index.php");
// desloga cliente


?>