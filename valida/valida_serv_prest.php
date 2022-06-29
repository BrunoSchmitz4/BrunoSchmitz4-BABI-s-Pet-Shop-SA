<?php

session_start();

include_once '../adm/config/conexao.php';

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
var_dump($dados);

if(!empty($dados['bt-prst-serv'])){
    //echo '<br>Deu certo!';
    
    $query_pedidos = "INSERT INTO servicos_prestados(servico_id, pet_id, usuario_id, preco_id, created) "
            . "VALUES ('".$dados['servico_id']."', '".$dados['pet_id']."', '".$dados['usuario_id']."', 
            '".$dados['preco_id']."', NOW())";
    
    $result_pedido = $conn->prepare($query_pedidos);
    $result_pedido->execute();
    
    if(($result_pedido) AND ($result_pedido->rowCount() != 0)){ 
        $row_pedido = $result_pedido->fetch(PDO::FETCH_ASSOC);
        $_SESSION['msg'] = "<h2><p style='color:green'>Pedido cadastrado com sucesso!</p></h2>";
        header("Location:../pags/colaborador.php");
        
    } else {
        $_SESSION['msg'] = "<h2><p style='color:red'>Não foi possível inserir o pedido!</p></h2>";
        header("Location:../pags/colaborador.php");
    }    
    
} else {
    $_SESSION['msg'] = "<h2><p style='color:red'>Não foi possível cadastrar seu pedido!</p></h2>";
    header("Location:../pags/colaborador.php");
}


