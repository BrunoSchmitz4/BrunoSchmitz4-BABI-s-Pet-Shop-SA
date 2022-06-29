<?php

session_start();

include_once '../adm/config/conexao.php';

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
var_dump($dados);

if(!empty($dados['bt_cadastro'])){
    //echo '<br>Deu certo!';
    $cripto_senha = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $cripto_senha['senha'] = password_hash($cripto_senha['senha'], PASSWORD_DEFAULT); //criptografa a senha 
    //$cripto_senha = password_hash($dados_cadastro['senha'],PASSWORD_DEFAULT);
    
    $query_cadastro = "INSERT INTO usuarios(nome, email, senha, telefone, complemento, nivel_acesso_id, cep_id, created) "
            . "VALUES ('".$dados['nome']."', '".$dados['email']."', '".$cripto_senha['senha']."', "
            . "'".$dados['telefone']."', '".$dados['complemento']."', '".$dados['nivel_acesso_id']."', "
            . "'".$dados['cep_id']."', NOW())";
    
    $result_usuario = $conn->prepare($query_cadastro);
    $result_usuario->execute();
    
    if(($result_usuario) AND ($result_usuario->rowCount() != 0)){ 
        $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
        $_SESSION['msg'] = "<h2><p style='color:green'>Cadastrado com sucesso!</p></h2>";
        header("Location:..\pags\cliente.php");
        
    } else {
        $_SESSION['msg'] = "<h2><p style='color:red'>Não foi possível inserir usuário!</p></h2>";
        header("Location:..\adm\cadastrar.php");
    }    
    
} else {
    $_SESSION['msg'] = "<h2><p style='color:red'>Não foi possível cadastrar!</p></h2>";
    header("Location:..\adm\cadastrar.php");
}


