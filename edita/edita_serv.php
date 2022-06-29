<!-- ////////////////////////////////////////////////////////////////////// Versão bia --> -->

<?php 

session_start();

include_once '../adm/config/conexao.php';

// if(!isset($_SESSION['id']) AND !isset($_SESSION['nome'])){
//     $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: necessário realizar o login para acessar a página!</p>";
//     header("Location:../pags/cliente.php");
// }

$id_serv = $_GET['id']; // recebe, pega id a ser atualizado pela url da página
echo "Id: ".$id_serv;

$query_edita_serv = "SELECT id, tipo_servico, descricao, imagem, created, modified FROM servicos WHERE id = $id_serv LIMIT 1";
// limit impede na hora de procurar usuário de ir verificando 1 por 1 se existe algum outro igual, perdendo tempo e espaço de processamento

$resultado_editar = $conn->prepare($query_edita_serv);
$resultado_editar->execute();


if(($resultado_editar) AND ($resultado_editar->rowCount() != 0)) {
    $row_edit_serv = $resultado_editar->fetch(PDO::FETCH_ASSOC);
}

?>

<html lang="pt-br">
    <head> 
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel='stylesheet' href='../css/bootstrap.css'/>
        <title>Edita Cadastro</title><!-- edição de usuário-->
    </head>
    <body>
        <div class="center">
            <?php
                if(isset($_SESSION['msg'])){
                    echo $_SESSION['msg'];
                    unset ($_SESSION['msg']);
                }
            ?>
            
            <h1 class="titulo">Cadastro de Serviços</h1><br> 
            <form method="POST" action="../valida/valida_edit_serv.php" enctype="multipart/form-data">
                            
            <div class="form-field">
                <label>Serviço:</label>
                <input type="text" name="servico" value="<?php echo $row_edit_serv['tipo_servico']; ?>" class='mod1_ta' required><br><br>   
            </div>
                            
            <div class="form-field">
                <p for="input-name" id="label-name">Sobre:</p>
                <!-- <input value="<?php echo $row_edit_serv['descricao']; ?>"> -->
                <textarea class='mod1_ta' rows='5' cols="25" labelledby="label-name" id="input-name" style="resize: none" name="descricao"  required><input value=<?php echo $row_edit_serv['descricao']; ?>></textarea><br><br><br>
                
            </div>
                            
            <div class="form-field">
                <label class="lbl_is">Imagem do Serviço:</label><br>
                <input class='mod1_ta' type="file" name="imagem" value="<?php echo $row_edit_serv['imagem']; ?>" accept="image/png,image/jpeg" required>                           
            </div><br><br><br>

            <input type="submit" name="editaServico" value="Salvar">
            <input type="reset" name="btRecuperar" class="signup_link_apagar" value="Redefinir"> 
            <!--Reculperar, restaura dados anteriores a modificação feita-->
        </form>
        </div>
    </body>
</html>