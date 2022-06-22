<?php
session_start();

include_once '../config/conexao.php';

if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}


$edita_cad_produto = filter_input(INPUT_POST, 'editaProduto', FILTER_SANITIZE_STRING);

if (!empty($edita_cad_produto)) {
    //recebe dados do formulario
    $nome = filter_input(INPUT_POST, 'nome_produto', FILTER_SANITIZE_STRING);
    $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
    $id_prod = filter_input(INPUT_POST,'id',FILTER_SANITIZE_NUMBER_INT);
    $imagem = $_FILES['imagens']['name'];
  
    
    //insere dados no bd
    $query_edita_produtos = "UPDATE produtos SET nome='$nome', descricao='$descricao', imagem='$imagem', modified=NOW() WHERE id='$id_prod'";
    
    $result_edita_prod = $conn->prepare($query_edita_produtos);
    $result_edita_prod->execute();

    //verifica se os dados foram inseridos
    if (($result_edita_prod) AND ($result_edita_prod->rowCount() != 0)) {
        $row_edita_produto = $result_edita_prod->fetch(PDO::FETCH_ASSOC);
        $_SESSION['msg'] = "<p style= 'color:green' >produto atualizado!</p>";
        header("Location:\projeto_login\adm\listar_produtos.php");

        //recuperar o ultimo insert
        //$last_insert = $conn->lastInsertId();

        //pasta onde a imagem será salva
        $pasta = "../imagem/" . $id_prod . '/';

        ///criar a pasta dentro da pasta de imagens         
        mkdir('../imagem/' . $id_prod . '/');

        if (move_uploaded_file($_FILES['imagens']['tmp_name'], $pasta . $imagem)) {
            $_SESSION['msg'] = "<p style= 'color:yellow' >Imagem alterada!</p>";
            header("Location:\projeto_login\adm\listar_produtos.php");
        } else {
            $_SESSION['msg'] = "<p style= 'color:white' >Imagem não alterada!</p>";
            header("Location:\projeto_login\adm\listar_produtos.php");
        }
    } else {
        $_SESSION['msg'] = "<p style= 'color:red' >Erro ao salvar os dados!</p>";
        header("Location:\projeto_login\index.php");
    }
} else {
    $_SESSION['msg'] = "<p style= 'color:red' >Erro ao salvar os dados!</p>";
   //header("Location:\projeto_login\index.php");
}
