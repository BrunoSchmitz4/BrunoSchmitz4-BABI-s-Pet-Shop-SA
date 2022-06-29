<?php
// versão bruno

// Nota: Passar conteúdo do Bruno para o edita user, 
//ajeitar e continuar vídeo da prof karize. (Minutagem parada: 2:55)

session_start();

$id_user = $_GET['id'];

include_once'../adm/config/conexao.php';

if (!isset($_SESSION['id']) AND !isset($_SESSION['nome'])){
    $_SESSION['msg'] = "<p style='color: white'>Parece que você não está logado, ou não contém o nível de acesso necessário :(</p>";
    header("Location../index.php");
}

// Query: Nível de acesso do usuário
$query_niveis_acessos = "SELECT * FROM niveis_acessos";
$result_nivel_acesso = $conn->prepare($query_niveis_acessos);
$result_nivel_acesso->execute();

// Query: CEP do usuário
$query_ceps = "SELECT * FROM ceps";
$result_ceps = $conn->prepare($query_ceps);
$result_ceps->execute();

$query_users = "SELECT * FROM usuarios where id = $id_user";
$result_users = $conn->prepare($query_users);
$result_users->execute();

if(($result_users) AND ($result_users->rowCount() != 0)){
    $row_edit_user = $result_users->fetch(PDO::FETCH_ASSOC);
    $nivel_acesso = $row_edit_user['nivel_acesso_id'];
    // $nivel_acesso_atual = $row_edit_user['nivel_acesso_id'];
    // $user = $row_edit_user['id'];
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
// if(!isset($_SESSION['id']) AND !isset($_SESSION['nome'])){
//     $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: necessário realizar o login para acessar a página!</p>";
//     header("Location:../pags/cliente.php");
// }

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
        
            <form method="POST" action="../valida/valida_edit_user.php?id=$row_edit_user['id']">
                
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
                
            <label>CEP:</label>

            <select class="form-control" name="cep_id"> 
                <?php
                    while ($row_cep = $result_cep->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <option value="<?php echo $row_cep['id'];?>"
                        <?php
                    if($row_edit_user['cep_id'] == $row_cep['id']){
                        echo 'selected';
                        
                    } 
                        ?>>
                        <?php echo $row_cep['cep'];?>
                </option>
                <?php }?>
                </select>
            
            <br><br> 
            
            <label>Nível de acesso:</label>
            <select class="form-control" name="nivel_acesso_id"> 
                <?php
                    while ($row_nivel_acesso = $result_nivel_acesso->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <option value="<?php echo $row_nivel_acesso['id'];?>"
                        <?php
                    if($row_edit_user['nivel_acesso_id'] == $row_nivel_acesso['id']){
                        echo 'selected';
                        
                    } 
                        ?>>
                        <?php echo $row_nivel_acesso['nome'];?>
                </option>
                <?php }?>
                </select>

            <br><br><br>

            <input type="submit" name="editaUsuario" value="Salvar">
            <input type="reset" name="btRecuperar" class="signup_link_apagar" value="Redefinir"> 
            <!--Reculperar, restaura dados anteriores a modificação feita-->
        </form>
        </div>
    </body>
</html>