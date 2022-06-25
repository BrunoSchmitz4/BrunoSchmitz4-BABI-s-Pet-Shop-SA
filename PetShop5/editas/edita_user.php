<!-- <?php

// session_start();


// include_once '../adm/config/conexao.php';
    
// if (isset($_SESSION['msg'])) {
//     echo $_SESSION['msg'];
//     unset($_SESSION['msg']);
// }

// if(!isset($_SESSION['id']) AND !isset($_session['nome'])){
// $_SESSION['msg'] = "<p style='color='red'>ERRO: Você precisa fazer o login para acessar esta página</p>";
// header("Location ../index.php");
// }

// $id_user = $_GET['id'];

// $query_edita_user = "SELECT id, nome, senha, email, telefone, complemento, cep_id, nivel_acesso_id FROM usuarios WHERE id = $id_user LIMIT 1";
// $resultado_editar = $conn->prepare($query_edita_user);
// $resultado_editar->execute();

// if (($resultado_editar) AND ($resultado_editar->rowCount()!= 0)){
//     $row_edit_user = $resultado_editar->fetch(PDO::FETCH_ASSOC);
// }


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
        
        // echo "Editando usuário $nome, pertencente do id $id";
        // $query_edita_user = "UPDATE `usuarios` SET `id`='$id',`nome`='$nome',`email`='$email',`senha`='$senha',`telefone`='$telefone',`complemento`='$complemento',`nivel_acesso_id`='$nivel_acesso_id',`cep_id`='$cep_id',`created`='$created',`modified`='$modified' WHERE id = $id_user LIMIT 1";
        // $resultado_editar = $conn->prepare($query_edita_user);
        // $resultado_editar->execute();



        // if (($resultado_editar) AND ($resultado_editar->rowCount() != 0)) {
        // $row_user_user = $resultado_editar->fetch(PDO::FETCH_ASSOC);
        // //header("Location:..\pags\admin.php");
        // echo "<form method='POST' action='../valida/valida_cadastro.php'>
                
        // <div class='txt_field'>
            
        //     <input type='text' name='nome' placeholder='$nome'required>
        //     <label>Nome:</label>
        // </div>
            
        // <div class='txt_field'>
                  
        //     <input type='email' name='email' placeholder='$email' required>
        //     <label>E-mail:</label>
        //     <!--<br><br> -->
        // </div>
            
        // <div class='txt_field'>      
            
        //     <input type='password' name='senha' placeholder='$senha' required>
        //     <label>Senha:</label>                           
        // </div>
            
        // <div class='txt_field'>   
            
        //     <input type='tel' name='telefone' placeholder='$telefone' required>
        //     <label>Telefone:</label>                    
        // </div>
            
        // <div class='txt_field'>
            
        //     <input type='text' name='complemento' placeholder='$complemento' required>
        //     <label>Complemento:</label>
        // </div>
            
        // <label>CEP:</label>
        // <select name='cep_id' id='cep_id'> 
        //     <?php 
        //     echo '<option value='$cep_id'>Selecione</option>'; 
        //     while ($row_cep = $result_cep->fetch(PDO::FETCH_ASSOC)) {
        //         extract($row_cep);
        //         echo '<option value = $id>$cep - $logradouro</option>';
        //     }
        //     ?>
         <!-- </select>
         <br><br>
        
        
         </select>

         <br><br><br>

         <input type='submit' name='bt_login' value='Cadastrar'> -->

         <!-- </form>'"; -->

         <!-- } else {
        //     $_SESSION['msg'] = "<p style= 'color:red' >Não foi possivel atualizar o usuário!</p>";
        //     header("Location:..\pags\admin.php");
        //     }
    ?> -->


<!-- ////////////////////////////////////////////////////////////////////// Versão bia --> -->

<?php 

session_start();

include_once '../adm/config/conexao.php';

// if(!isset($_SESSION['id']) AND !isset($_SESSION['nome'])){
//     $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: necessário realizar o login para acessar a página!</p>";
//     header("Location:../pags/cliente.php");
// }

$id_user = $_GET['id']; // recebe, pega id a ser atualizado pela url da página
echo "Id: ".$id_user;

$query_edita_user = "SELECT id, nome, email, senha, telefone, complemento, nivel_acesso_id, cep_id, created, modified FROM usuarios WHERE id = $id_user LIMIT 1";
// limit impede na hora de procurar usuário de ir verificando 1 por 1 se existe algum outro igual, perdendo tempo e espaço de processamento

$resultado_editar = $conn->prepare($query_edita_user);
$resultado_editar->execute();

$query_ceps = "SELECT id, cep, logradouro FROM ceps ORDER BY cep ASC"; 
$result_cep = $conn->prepare($query_ceps); 
$result_cep->execute(); 

$query_niveis_acessos = "SELECT id, nome FROM niveis_acessos ORDER BY nome ASC"; 
$result_nivel_acesso = $conn->prepare($query_niveis_acessos); 
$result_nivel_acesso->execute();

if(($resultado_editar) AND ($resultado_editar->rowCount() != 0)) {
    $row_edit_user = $resultado_editar->fetch(PDO::FETCH_ASSOC);
}

?>

<html>
    <head> 
        <meta charset="UTF-8">
        <link rel='stylesheet' href='../css/style.css'/>
        <title>Edita Cadastro</title>
    </head>
    <body>
        <div class ="center">
            <?php
            if(isset($_SESSION['msg'])){
                echo $_SESSION['msg'];
                unset ($_SESSION['msg']);
            }

            ?>
            <h1>Cadastrar usuário</h1> 
        
            <form method="POST" action="../valida/valida_edita_usuario.php">
                
            <div class="txt_field">
                
                <input type="text" name="nome" value="<?php echo $row_edit_user['nome']; ?>" required>
                 <!-- value reculpera o que tinha sido digitado no campo -->
                <label>Nome:</label>
            </div>
                
            <div class="txt_field">
                      
                <input type="email" name="email" value="<?php echo $row_edit_user['email']; ?>" required>
                <label>E-mail:</label>
                <!--<br><br> -->
            </div>
                
            <div class="txt_field">      
                
                <input type="password" name="senha" value="<?php echo $row_edit_user['senha']; ?>" required>
                <label>Senha:</label>                           
            </div>
                
            <div class="txt_field">   
                
                <input type="tel" name="telefone" value="<?php echo $row_edit_user['telefone']; ?>" required>
                <label>Telefone:</label>                    
            </div>
                
            <div class="txt_field">
                
                <input type="text" name="complemento" value="<?php echo $row_edit_user['complemento']; ?>" required>
                <label>Complemento:</label>
            </div>
                
            <label>CEP:<?php echo $row_edit_user['cep_id']; ?></label>
            <select name="cep_id" id="cep_id" value="<?php echo $row_edit_user['cep_id']; ?>" required> 
                <?php
                echo "<option value=''>Selecione</option>";
                while ($row_cep = $result_cep->fetch(PDO::FETCH_ASSOC)) {
                    extract($row_cep);
                    echo "<option value = $id>$cep - $logradouro</option>";
                }
                ?>
            </select>
            <br><br> 
            
            <label>Nível de acesso:</label>
            <select name="nivel_acesso_id" id="nivel_acesso_id" value="<?php echo $row_edit_user['nivel_acesso_id']; ?>" required>                                  
                <?php                
                  echo "<option value=''>Selecione</option>"; 
                 while($row_nivel_acesso = $result_nivel_acesso->fetch(PDO::FETCH_ASSOC)){ 
                     extract($row_nivel_acesso); 
                     echo "<option value = $id>$nome</option>"; 
                }
//                     <option value="1">Cliente</option>
//                     <option value="2">Colaborador</option>
//                     <option value="3">Administrador</option>;
                ?>
            </select>

            <br><br><br>

            <input type="submit" name="editaUsuario" value="Salvar">
            <input type="reset" name="btRecuperar" class="signup_link_apagar" value="Redefinir"> 
            <!--Reculperar, restaura dados anteriores a modificação feita-->
        </form>
        </div>
    </body>
</html>