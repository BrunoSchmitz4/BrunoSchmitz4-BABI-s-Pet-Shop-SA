<?php

session_start();

include_once '../adm/config/conexao.php';

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
var_dump($dados);

if(!empty($dados['bt_cadpet'])){
    //echo '<br>Deu certo!';
    
//    $cripto_senha = password_hash($dados_cadastro['senha'],PASSWORD_DEFAULT);
    
    $query_cadastro = "INSERT INTO pets(nome, especie_id, porte_id, created) "
            . "VALUES ('".$dados['pet_nome']."', '".$dados['especie_id']."', '".$dados['porte_id']."', NOW())";

    // $query_serv = "INSERT INTO servicos_prestados(servico_id, created) "
    // . "VALUES ('".$dados['servico_id']."', NOW())";
    
    $result_usuario = $conn->prepare($query_cadastro);
    $result_usuario->execute();

    // $result_servico = $conn->prepare($query_serv);
    // $result_servico->execute();
    
    if(($result_usuario) AND ($result_usuario->rowCount() != 0)){ 
        $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
        $_SESSION['msg'] = "<h2><p style='color:green'>Pet cadastrado com sucesso!</p></h2>";
        header("Location:../pags/clientelogged.php");
        
    } else {
        $_SESSION['msg'] = "<h2><p style='color:red'>Não foi possível inserir o pet!</p></h2>";
        header("Location:../pags/formlogged.php");
    }
    
    // if(($result_servico) AND ($result_servico->rowCount() != 0)){ 
    //     $row_serv = $result_servico->fetch(PDO::FETCH_ASSOC);
    //     $_SESSION['msg'] = "<h2><p style='color:green'>Pedido enviado com sucesso!</p></h2>";
    //     header("Location:../pags/clientelogged.php");
        
    // } else {
    //     $_SESSION['msg'] = "<h2><p style='color:red'>Não foi possível fazer o pedido, tente novamente mais tarde :(</p></h2>";
    //     header("Location:../pags/formlogged.php");
    // }    
    
} else {
    $_SESSION['msg'] = "<h2><p style='color:red'>Não foi possível cadastrar seu pet!</p></h2>";
    header("Location:../pags\/formlogged.php");

}


