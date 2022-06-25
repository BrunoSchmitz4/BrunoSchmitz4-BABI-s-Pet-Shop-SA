// versão bia
<?php

session_start();

include_once'../adm/config/conexao.php';

if(isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset ($_SESSION['msg']);
}


$edita_cad_usuario = filter_input(INPUT_POST, 'editaUsuario', FILTER_SANITIZE_STRING);
var_dump($edita_cad_usuario);


if(!empty($edita_cad_usuario)){
    //echo '<br>Deu certo!';
    
//    $cripto_senha = password_hash($dados_cadastro['senha'],PASSWORD_DEFAULT);
    
    $query_edita_usuarios = "UPDATE usuarios SET nome='$nome', email='$email', senha='$senha', 
    telefone='$telefone', complemento='$complemento', nivel_acesso_id='$nivel_acesso_id', 
    cep_id='$cep_id', created='$created', modified='$modified' WHERE id='$id_user' LIMIT 1"; // busca id atráves do valor que consta no banco
    
    $result_edita_user = $conn->prepare($query_edita_usuarios);
    $result_edita_user->execute();
    
    if(($result_edita_user) AND ($result_edita_user->rowCount() != 0)){ 
        $row_edita_usuario = $result_edita_user->fetch(PDO::FETCH_ASSOC);
        $_SESSION['msg'] = "<p style='color:green'>Usuário atualizado com sucesso!</p>";
        header("Location:..\pags\admin.php");
        
    } else {
        $_SESSION['msg'] = "<p style='color:red'>Não foi possível atualizar usuário!</p>";
        header("Location:..\pags\admin.php");
    }    
    
} else {
    $_SESSION['msg'] = "<p style='color:red'>Não foi possível atualizar usuário!</p>";
    header("Location:..\pags\admin.php");
}



?>