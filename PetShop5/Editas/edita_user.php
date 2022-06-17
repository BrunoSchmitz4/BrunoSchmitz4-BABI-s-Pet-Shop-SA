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

$id_user = $_GET['id'];

$query_edita_user = "SELECT id, nome, senha, email, telefone, complemento, cep_id, nivel_acesso_id FROM usuarios WHERE id = $id_user LIMIT 1";
$resultado_editar = $conn->prepare($query_edita_user);
$resultado_editar->execute();

if (($resultado_editar) AND ($resultado_editar->rowCount()!= 0)){
    $row_edit_user = $resultado_editar->fetch(PDO::FETCH_ASSOC);
}


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição de Usuário</title>
    <body>
        
    </body>
</head>

<?php
        
        echo "Editando usuário $nome, pertencente do id $id";
        $query_edita_user = "UPDATE `usuarios` SET `id`='$id',`nome`='$nome',`email`='$email',`senha`='$senha',`telefone`='$telefone',`complemento`='$complemento',`nivel_acesso_id`='$nivel_acesso_id',`cep_id`='$cep_id',`created`='$created',`modified`='$modified' WHERE id = $id_user LIMIT 1";
        $resultado_editar = $conn->prepare($query_edita_user);
        $resultado_editar->execute();



        if (($resultado_editar) AND ($resultado_editar->rowCount() != 0)) {
        $row_user_user = $resultado_editar->fetch(PDO::FETCH_ASSOC);
        //header("Location:..\pags\admin.php");
        echo "<form method='POST' action='../valida/valida_cadastro.php'>
                
        <div class='txt_field'>
            
            <input type='text' name='nome' placeholder='$nome'required>
            <label>Nome:</label>
        </div>
            
        <div class='txt_field'>
                  
            <input type='email' name='email' placeholder='$email' required>
            <label>E-mail:</label>
            <!--<br><br> -->
        </div>
            
        <div class='txt_field'>      
            
            <input type='password' name='senha' placeholder='$senha' required>
            <label>Senha:</label>                           
        </div>
            
        <div class='txt_field'>   
            
            <input type='tel' name='telefone' placeholder='$telefone' required>
            <label>Telefone:</label>                    
        </div>
            
        <div class='txt_field'>
            
            <input type='text' name='complemento' placeholder='$complemento' required>
            <label>Complemento:</label>
        </div>
            
        <label>CEP:</label>
        <select name='cep_id' id='cep_id'> 
            <?php 
            echo '<option value='$cep_id'>Selecione</option>'; 
            while ($row_cep = $result_cep->fetch(PDO::FETCH_ASSOC)) {
                extract($row_cep);
                echo '<option value = $id>$cep - $logradouro</option>';
            }
            ?>
        </select>
        <br><br>
        
        
        </select>

        <br><br><br>

        <input type='submit' name='bt_login' value='Cadastrar'>

        </form>'";

        } else {
            $_SESSION['msg'] = "<p style= 'color:red' >Não foi possivel atualizar o usuário!</p>";
            header("Location:..\pags\admin.php");
            }
    ?>

