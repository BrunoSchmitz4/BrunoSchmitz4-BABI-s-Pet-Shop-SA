<!-- //// Versão bia --> -->

<?php 

session_start();

include_once '../adm/config/conexao.php';

// if(!isset($_SESSION['id']) AND !isset($_SESSION['nome'])){
//     $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: necessário realizar o login para acessar a página!</p>";
//     header("Location:../pags/cliente.php");
// }

$id_pet = $_GET['id']; // recebe, pega id a ser atualizado pela url da página
echo "Id: ".$id_pet;

$query_edita_pet = "SELECT id, nome, especie_id, porte_id, created, modified FROM pets WHERE id = $id_pet LIMIT 1";
// limit impede na hora de procurar usuário de ir verificando 1 por 1 se existe algum outro igual, perdendo tempo e espaço de processamento

$resultado_editar = $conn->prepare($query_edita_pet);
$resultado_editar->execute();

$query_especies = "SELECT id, nome FROM especies ORDER BY nome ASC"; 
$result_especie = $conn->prepare($query_especies); 
$result_especie->execute(); 

$query_portes = "SELECT id, nome FROM portes ORDER BY nome ASC"; 
$result_porte = $conn->prepare($query_portes); 
$result_porte->execute();

if(($resultado_editar) AND ($resultado_editar->rowCount() != 0)) {
    $row_edit_pet = $resultado_editar->fetch(PDO::FETCH_ASSOC);
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
            <h1 class="titulo">Cadastro de Pet</h1><br> 

            <form method="POST" action="../valida/valida_edit_pet.php">

            <div class="conteudo-form">
            <div class="campo-form">
                <label class="label-form" >Nome do pet:</label>
                <input class="inserts-form" class="input-form" type="text" name="pet_nome" value="<?php echo $row_edit_pet['nome']; ?>" required>
            </div>

            <div class="campo-form">

                <label class="label-form">Porte do pet</label>
                <select name="porte_id" value="<?php echo $row_edit_pet['porte_id']; ?>" class="select-form" class="inserts-form">
                    <?php
                        echo "<option value=''>Selecione</option>";
                        while ($row_portes = $result_porte->fetch(PDO::FETCH_ASSOC)) {
                            extract($row_portes);
                            echo "<option value = $id>$id - $nome</option>";
                        }
                    ?>
                </select>

            </div>

            <div class="campo-form">

                <label class="label-form">Espécie do pet</label>
                <select name="especie_id" value="<?php echo $row_edit_pet['especie_id']; ?>" class="select-form" class="inserts-form">
                <?php
                    echo "<option value=''>Selecione</option>";
                    while ($row_especies = $result_especie->fetch(PDO::FETCH_ASSOC)) {
                        extract($row_especies);
                        echo "<option value = $id>$id - $nome</option>";
                    }
                ?>
                </select><br><br>

            </div>
            </div>

            <input type="submit" name="editaPet" value="Salvar">
            <input type="reset" name="btRecuperar" class="signup_link_apagar" value="Redefinir"> 
            <!--Reculperar, restaura dados anteriores a modificação feita-->
        </form>
        </div>
    </body>
</html>