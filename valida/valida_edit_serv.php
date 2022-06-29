<?php

session_start();

include_once '../adm/config/conexao.php';

if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

$edita_cad_serv = filter_input(INPUT_POST, 'editaServico', FILTER_SANITIZE_STRING);

if (!empty($edita_cad_serv)) {
    //recebe dados do formulario
    $nome = filter_input(INPUT_POST, 'tipo_servico', FILTER_SANITIZE_STRING);
    $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
    $id_serv = filter_input(INPUT_POST,'id',FILTER_SANITIZE_NUMBER_INT);
    $imagem = $_FILES['imagens']['name'];
    
    echo $imagem;
    
    //insere dados no bd
    $query_edita_servicos = "UPDATE servicos SET tipo_servico='$tipo_servico', descricao='$descricao', imagem='$imagem', modified=NOW() WHERE id='$id_serv'";
    
    $result_edita_serv = $conn->prepare($query_edita_servicos);
    $result_edita_serv->execute();

    //verifica se os dados foram inseridos
    if (($result_edita_serv) AND ($result_edita_serv->rowCount() != 0)) {
        $row_edita_servico = $result_edita_serv->fetch(PDO::FETCH_ASSOC);
        $_SESSION['msg'] = "<p style= 'color:green' >Serviço atualizado!</p>";
        header("Location:..\pags\admin.php");

        //recuperar o último insert
        //$last_insert = $conn->lastInsertId();

        //pasta onde a imagem será salva
        $pasta = "../imagem/" . $id_serv . '/';

        // criar a pasta dentro da pasta de imagens         
        mkdir('../imagem/' . $id_serv . '/');

        if (move_uploaded_file($_FILES['imagens']['tmp_name'], $pasta . $imagem)) {
            $_SESSION['msg'] = "<p style= 'color:yellow' >Imagem alterada!</p>";
            header("Location:..\pags\admin.php");
        } else {
            $_SESSION['msg'] = "<p style= 'color:white' >Imagem não alterada!</p>";
            header("Location:..\pags\admin.php");
        }
    } else {
        $_SESSION['msg'] = "<p style= 'color:red' >Erro ao salvar os dados!</p>";
        header("Location:..\pags\admin.php");
    }
} else {
    $_SESSION['msg'] = "<p style= 'color:red' >Erro ao salvar os dados!</p>";
   //header("Location:..\pags\admin.php");
}
