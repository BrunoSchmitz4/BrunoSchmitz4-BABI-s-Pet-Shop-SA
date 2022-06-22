<?php

session_start();

// echo "Crie seu formulário Cadastrar<br>";

include_once '../adm/config/conexao.php';
    
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}


$query_users_b = "SELECT id, nome, email, senha, telefone, complemento, nivel_acesso_id, cep_id, created, modified FROM usuarios ORDER BY nome ASC";
$query_pets_b = "SELECT id, nome, especie_id, porte_id, created, modified FROM pets ORDER BY nome ASC";

$result_users_b = $conn->prepare($query_users_b); 
$result_users_b->execute();

$result_pets_b = $conn->prepare($query_pets_b); 
$result_pets_b->execute();

echo "<br>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Editor ADM</title>

</head>
    <body>
        <header>

        </header>
        <main>

        </main>
        <footer>
            
        </footer> 
    </body>
</html>