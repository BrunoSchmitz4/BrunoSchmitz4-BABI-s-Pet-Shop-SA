<?php

session_start();

include_once '../adm/config/conexao.php';
    
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

if(!isset($_SESSION['id']) AND !isset($_session['nome'])){
$_SESSION['msg'] = "<p style='color='red'>ERRO: Você precisa fazer o login para acessar esta página</p>";
header("Location ../index.php");
}
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exclusão de Pets</title>
    <body>

    </body>
</head>
</html>

<?php
$id_pet = $_GET['id'];

$query_deleta_pet = "DELETE FROM pets WHERE id = $id_pet LIMIT 1";
$resultado_deletar = $conn->prepare($query_deleta_pet);
$resultado_deletar->execute();



if (($resultado_deletar) AND ($resultado_deletar->rowCount() != 0)) {
$row_deleta_serv = $resultado_deletar->fetch(PDO::FETCH_ASSOC);
$_SESSION['msg'] = "<p style= 'color:green'>Pet deletado!</p>"; // color:brown
header("Location:..\pags\admin.php");

} else {
    $_SESSION['msg'] = "<p style= 'color:red' >Não foi possivel deletar pet!</p>";
    header("Location:..\pags\admin.php");
}