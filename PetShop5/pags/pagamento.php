<?php

session_start();

// echo "Crie seu formulário Cadastrar<br>";

include_once '../adm/config/conexao.php';
    
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>

<html>
    <head> 
        <meta charset="UTF-8">
        <link rel='stylesheet' href='../css/cliente.css'>
        <title>Pagamentos</title>
    </head>
    <body>
        
    </body>
</html>
