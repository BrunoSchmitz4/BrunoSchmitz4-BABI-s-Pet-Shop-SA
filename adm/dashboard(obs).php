<?php

session_start();

// echo "Crie seu formulário Cadastrar<br>";

include_once '../adm/config/conexao.php';
    
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

echo "<h1>Olá ".$_SESSION['nome'].", você chegou no dashboard!</h1>"; // reculpera dado sessão
echo "<h1>Sua senha é: ".$_SESSION['senha']."</h1>"; 
echo "<h1>Seu id é: ".$_SESSION['id']."</h1>"; 

