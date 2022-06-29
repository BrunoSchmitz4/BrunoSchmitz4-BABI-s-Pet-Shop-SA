// versão bia
<?php

session_start();

$id_user = $_GET['id'];

include_once '../adm/config/conexao.php';

if(isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset ($_SESSION['msg']);
}

$dados_cadastro = filter_input(INPUT_POST, 'editaUsuario', FILTER_SANITIZE_STRING);
// $dados_cadastro = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//$id_user = $_GET['id'];

if(!empty($update_user)){
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
    $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);
    $complemento = filter_input(INPUT_POST, 'complemento', FILTER_SANITIZE_STRING);
    $nivel_acesso_id = filter_input(INPUT_POST, 'nivel_acesso_id', FILTER_SANITIZE_NUMBER_INT);
    $cep_id = filter_input(INPUT_POST, 'cep_id', FILTER_SANITIZE_NUMBER_INT);

$query_update = "UPDATE usuarios SET nome = '$nome', email = '$email', senha = '$senha', telefone = '$telefone', complemento = '$complemento', nivel_acesso_id = '$nivel_acesso_id', cep_id = '$cep_id', modified=NOW() WHERE email = $email AND telefone = $telefone LIMIT 1";

$result_update = $conn->prepare($query_update);
$result_update->execute();

    if (($result_update) AND ($result_update->rowCount() !=0)){
        $row_user = $result_update -> fetch (PDO::FETCH_ASSOC);
        $_SESSION['msg'] = "<h3><p style='color:white'>Usuário atualizado com sucesso! :)";
        header("Location:..\pags\admin.php");
    } else {
        $_SESSION['msg'] = "<p style= 'color:red' >Falha na atualização :(</p>";
        header("Location:..\pags\admin.php");
    }
    } else {
        $_SESSION['msg'] = "<p style= 'color:white' >Falha na atualização :/</p>";
        header("Location:..\pags\admin.php");
}

// if(!empty($dados_cadastro['editaUsuario'])){
//     var_dump($dados_cadastro);
//     $cripto_senha = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//     $cripto_senha['senha'] = password_hash($cripto_senha['senha'], PASSWORD_DEFAULT);
//     //echo '<br>Deu certo!';
    
//     //    $cripto_senha = password_hash($dados_cadastro['senha'],PASSWORD_DEFAULT);
    
//     // echo "Editando usuário $nome, pertencente do id $id";


//     $query_edita_usuarios = "UPDATE usuarios SET 
//     'nome'=".$dados_cadastro['nome'].", 
//     'email'=".$dados_cadastro['email'].", 
//     'senha'=".$dados_cadastro['senha'].", 
//     'telefone'=".$dados_cadastro['telefone'].", 
//     'complemento'=".$dados_cadastro['complemento'].", 
//     'nivel_acesso_id'=".$dados_cadastro['nivel_acesso_id'].",
//     'cep'=".$dados_cadastro['cep_id'].",
//     'modified'= NOW()
//     WHERE id=$id_user"; 
//busca id atráves do valor que consta no banco
    
//     $result_edita_user = $conn->prepare($query_edita_usuarios);
//     $result_edita_user->execute();
    
//     if(($result_edita_user) AND ($result_edita_user->rowCount() != 0)){ 
//         $row_edita_usuario = $result_edita_user->fetch(PDO::FETCH_ASSOC);
//         $_SESSION['msg'] = "<p style='color:green'>Usuário atualizado com sucesso!</p>";
//         header("Location:..\pags\admin.php");
        
//     } else {
//         $_SESSION['msg'] = "<p style='color:red'>Não foi possível atualizar usuário!</p>";
//         header("Location:..\pags\admin.php");
//     }    
    
// } else {
//     $_SESSION['msg'] = "<p style='color:red'>Não foi possível atualizar usuário!</p>";
//     header("Location:..\pags\admin.php");
// }

?>