<!-- //// Versão bia --> -->

<?php 

session_start();

include_once '../adm/config/conexao.php';

// if(!isset($_SESSION['id']) AND !isset($_SESSION['nome'])){
//     $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: necessário realizar o login para acessar a página!</p>";
//     header("Location:../pags/cliente.php");
// }

$id_servp = $_GET['id']; // recebe, pega id a ser atualizado pela url da página
echo "Id: ".$id_servp;

$query_edita_servp = "SELECT id, servico_id, pet_id, usuario_id, preco_id FROM servicos_prestados ORDER BY id ASC";
// limit impede na hora de procurar usuário de ir verificando 1 por 1 se existe algum outro igual, perdendo tempo e espaço de processamento

$resultado_editar = $conn->prepare($query_edita_servp);
$resultado_editar->execute();

$query_users = "SELECT id, nome, email, senha, telefone, complemento, nivel_acesso_id, cep_id, created, modified FROM usuarios ORDER BY nivel_acesso_id DESC";
$result_user = $conn->prepare($query_users); 
$result_user->execute();

$query_pets = "SELECT id, nome, especie_id, porte_id, created, modified FROM pets ORDER BY nome ASC";
$result_pet = $conn->prepare($query_pets); 
$result_pet->execute();

$query_servicos = "SELECT id, tipo_servico, descricao, imagem, created, modified FROM servicos ORDER BY id ASC";
$result_servico = $conn->prepare($query_servicos);
$result_servico->execute();

$query_precos = "SELECT id, valor, porte_id, created, modified FROM precos ORDER BY valor ASC";
$result_preco = $conn->prepare($query_precos);
$result_preco->execute();


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
        <title>Edita Serviço Prestado</title>
    </head>
    <body>
        <div class="center">
        <?php
                if(isset($_SESSION['msg'])){
                    echo $_SESSION['msg'];
                    unset ($_SESSION['msg']);
                }
            ?>
            <h1 class="titulo">Cadastro de Pedido de Serviços</h1><br> 
            <form method="POST" action="../valida/valida_edit_servp.php" enctype="multipart/form-data">

            <label>Serviço a prestar:</label>
            <select name='servico_id' id='servico_id'>
                <?php
                    echo "<option value=''>Selecione</option>";
                    while ($row_servicos_ps = $result_servicos_ps->fetch(PDO::FETCH_ASSOC)) {
                        extract($row_servicos_ps);
                        echo "<option value = $id>$tipo_servico</option>";
                    }?>
            </select>

            <label>Selecionar Pet:</label>
            <select name='pet_id' id='pet_id'>
                <?php
                    echo "<option value=''>Selecione</option>";
                    while ($row_pets_ps = $result_pet_ps->fetch(PDO::FETCH_ASSOC)) {
                        extract($row_pets_ps);
                        echo "<option value = $id>$nome</option>";
                    }?>
            </select>

            <label>Selecionar Usuário:</label>
            <select name='idServico' id='idServico'>
                <?php
                    echo "<option value=''>Selecione</option>";
                    while ($row_user_ps = $result_user_ps->fetch(PDO::FETCH_ASSOC)) {
                        extract($row_user_ps);
                        echo "<option value = $id>$nome</option>";
                    }?>
            </select>
            <label>Selecionar Preço:</label>
            <select name='idServico' id='idServico'>
                <?php
                    echo "<option value=''>Selecione</option>";
                    while ($row_precos_ps = $result_precos_ps->fetch(PDO::FETCH_ASSOC)) {
                        extract($row_precos_ps);
                        echo "<option value = $id>R$ $valor,00</option>";
                    }?>
            </select><br><br><br>
                                                
            <input type="submit" name="EditaServPrest" value="Cadastrar Produto">

        </form>
        </div>
    </body>
</html>