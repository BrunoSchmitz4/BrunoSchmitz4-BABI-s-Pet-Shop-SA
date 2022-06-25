<?php

session_start();

// echo "Crie seu formulário Cadastrar<br>";

include_once '../adm/config/conexao.php';
    
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

// echo "Crie seu formulário Cadastrar<br>";

include_once '../adm/config/conexao.php';

if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}



$query_users_b = "SELECT id, nome, email, senha, telefone, complemento, nivel_acesso_id, cep_id, created, modified FROM usuarios ORDER BY nome ASC";
$query_pets_b = "SELECT id, nome, especie_id, porte_id, created, modified FROM pets ORDER BY nome ASC";

$result_users_b = $conn->prepare($query_users_b); 
$result_users_b->execute();

$query_users_a = "SELECT id, nome, email, senha, telefone, complemento, nivel_acesso_id, cep_id, created, modified FROM usuarios ORDER BY nivel_acesso_id DESC";
$result_users_a = $conn->prepare($query_users_a); 
$result_users_a->execute();

$result_pets_b = $conn->prepare($query_pets_b); 
$result_pets_b->execute();

$query_servicos = "SELECT id, tipo_servico, descricao, imagem FROM servicos ORDER BY id ASC";
$result_servicos = $conn->prepare($query_servicos);
$result_servicos->execute();

$query_prst_serv = "SELECT id, servico_id, pet_id, usuario_id FROM servicos_prestados ORDER BY id ASC";
$result_prst_serv = $conn->prepare($query_prst_serv);
$result_prst_serv->execute();

$query_ceps = "SELECT id, cep, logradouro FROM ceps ORDER BY cep ASC";
$result_cep = $conn->prepare($query_ceps);
$result_cep->execute();

$query_niveis_acessos = "SELECT id, nome FROM niveis_acessos ORDER BY nome ASC"; 
$result_nivel_acesso = $conn->prepare($query_niveis_acessos); 
$result_nivel_acesso->execute();
// var_dump($result_nivel_acesso);

// Query dos portes
$query_portes = "SELECT id, nome FROM portes ORDER BY nome ASC"; 
$result_portes = $conn->prepare($query_portes); 
$result_portes->execute();    
// var_dump($result_nivel_acesso);

// Query das espécies
$query_especies = "SELECT id, nome FROM especies ORDER BY nome ASC";
$result_especies = $conn->prepare($query_especies);
$result_especies->execute();


// Queries para modal "Prestar Serviços"

$query_servicos_ps = "SELECT id, tipo_servico FROM servicos ORDER BY tipo_servico ASC";
$result_servicos_ps = $conn->prepare($query_servicos_ps);
$result_servicos_ps->execute();

$query_pet_ps = "SELECT id, nome FROM pets ORDER BY nome ASC";
$result_pet_ps = $conn->prepare($query_pet_ps);
$result_pet_ps->execute();

$query_user_ps = "SELECT id, nome FROM usuarios ORDER BY nome ASC";
$result_user_ps = $conn->prepare($query_user_ps);
$result_user_ps->execute();

$query_precos_ps = "SELECT id, valor, portes_id FROM precos ORDER BY valor ASC";
$result_precos_ps = $conn->prepare($query_precos_ps);
$result_precos_ps->execute();



echo "<br>";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espaço Admin</title>

    <link rel="stylesheet" href="../css/bootstrap.css"> <!-- CSS para botão da tela modal-->
</head>
    <body class="escopo">
    <div>
        <header class="cabecalho">
            <img class="cabecalho_imagem" src="../css/imgs/Logo_SA.png" alt="Logo do pet shop">
            <nav class="cabecalho_menu"> 
                <!--<a class="cabecalho_menu_item" href="../index.php">Login</a> Antigo botão login, agora substituído por uma condicional.--> 
                <div class="cl-log">
                    <?php
                        echo "<h2>Bem vindo(a) ".$_SESSION['nome']."!</h2>"; 
                    ?>
                </div>
                 <!--Links par navegação entre as páginas-->
                 <a class="cabecalho_menu_item" href="contato.php">Contato</a>
                <a class="cabecalho_menu_item" href="sobre.php">Sobre</a>
                <a class="cabecalho_menu_item" href="clientelogged.php">Ir à página do cliente</a>
                <a class="cabecalho_menu_item" href="cliente_loggout.php">Encerrar Sessão</a>
            </nav>
        </header>
        <main class="caixa-botoes">
            <br>
            <div class="container-bt"><!--Container dos modais de cadastro-->
                <button type="button" class="btn-btn-primary" data-toggle="modal" data-target="#ModalCad1">
                    Cadastrar Serviço
                </button>
                <button type="button" class="btn-btn-primary" data-toggle="modal" data-target="#ModalCad5">
                    Cadastrar Usuários
                </button>
                <button type="button" class="btn-btn-primary" data-toggle="modal" data-target="#ModalCad6">
                    Cadastrar Pet
                </button>
                <button type="button" class="btn-btn-primary" data-toggle="modal" data-target="#ModalCad7">
                    Cadastrar Pedido
                </button>
            </div>
            <div class="container-bt"><!--Container dos modais de verificação-->
                <button type="button" class="btn-btn-primary" data-toggle="modal" data-target="#ModalCad4">
                    Verificar Serviço
                </button>
                <button type="button" class="btn-btn-primary" data-toggle="modal" data-target="#ModalCad2">
                    Verificar Usuários
                </button>
                <button type="button" class="btn-btn-primary" data-toggle="modal" data-target="#ModalCad3">
                    Verificar Pet
                </button>
                
                <button type="button" class="btn-btn-primary" data-toggle="modal" data-target="#ModalCad8">
                    Verificar Pedidos
                </button>
            </div>
            
        </main>

         <div class="paineis"> <!--DIV 1-->
        
            <!-- Modal 1-->
            <div class="modal fade" id="ModalCad1" tabindex="-1" role="dialog" aria-labelledby="ModalCad1" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalCad1">Novo Serviço</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <div class="center">
                        <h1 class="titulo">Cadastro de Serviços</h1><br> 
                        <form method="POST" action="../valida/valida_servico.php" enctype="multipart/form-data">
                            
                        <div class="form-field">
                            <label>Serviço:</label>
                            <input type="text" name="servico" class='mod1_ta' required>   
                        </div>
                            
                        <div class="form-field">
                            <p for="input-name" id="label-name">Sobre:</p>
                            <textarea class='mod1_ta' rows='5' cols="25" labelledby="label-name" id="input-name" style="resize: none" name="descricao" placeholder="Descreva o serviço..." required></textarea>
                        </div>
                            
                        <div class="form-field">
                            <label class="lbl_is">Imagem do Serviço:</label>
                            <input class='mod1_ta' type="file" name="imagem" accept="image/png,image/jpeg" required>                           
                        </div><br><br> 
                            
                            <input type="submit" name="bt-servico" value="Cadastrar Produto">

                        </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </div>
                        </div>
                    </div>
                </div>
        </div>
                
            <!--Modal 2-->
            <div class="modal fade" id="ModalCad2" tabindex="-1" role="dialog" aria-labelledby="ModalCad2" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalCad2">Verificar Usuário</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <div class="center">
                        <h1 class="titulo">Lista de Usuários Cadastrados</h1><br> 

                        <!-- Topo do Formulário-->
                        <div class="listar_usuario">
                        <table class="table_users table-bordere-dark"> <!--Tabela HTML-->
            <tr> <!--Cria uma linha de uma tabela-->
                <td class="table-cel">ID</td><!--Cria uma coluna em uma linha-->
                <td class="table-cel">Nome</td>
                <td class="table-cel">E-mail</td>
                <td class="table-cel">Senha</td>
                <td class="table-cel">Complemento</td>
                <td class="table-cel">ID do Nível de Acesso</td>
                <td class="table-cel">ID do CEP</td>
                <td class="table-cel">Criação</td>
                <td class="table-cel">Modificação</td>
                <td class="table-cel-btex">Edição</td>
                <td class="table-cel-bted">Exclusão</td>
            </tr>
            <?php
                while($row_user_b = $result_users_b->fetch(PDO::FETCH_ASSOC)){ // outro método extração
                    extract($row_user_b); // traz linha row relaciona, conteúdo array campo
                    echo 
                    "<tr>
                        <td class='table_content'>$id </td>
                        <td class='table_content'>$nome </td>
                        <td class='table_content'>$email </td>
                        <td class='table_content'>$senha </td>
                        <td class='table_content'>$complemento </td>
                        <td class='table_content'>$nivel_acesso_id </td>
                        <td class='table_content'>$cep_id </td>
                        <td class='table_content'>".date('d/m/y H:i:s', strtotime($created))."</td>
                        <td class='table_content'>".date('d/m/y H:i:s', strtotime($modified))."</td>";
                        if(!empty($modified)){
                            //echo date('d/m/y H:i:s', strtotime($modified));
                            // echo "Sem modificação";
                        };
                        echo 
                        "<td class='table_content'><a href=../editas/edita_user.php?id=$id>
                        <button type = 'button' class= 'btn btn-sm btn-success'>Editar</button></a></td>";

                        echo "<td class='table_content'><a href='../deletas/deleta_user.php?id=".$id."'data-confirm='tem certeza que deseha apagar?'><button type = 'button'  class= 'btn btn-sm btn-danger'>Excluir</button></a></td></tr>"; 
                }
            ?>

  
        </table>
                        </div>
                        <!-- Fim do Formulário-->

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Modal 3-->
            <div class="modal fade" id="ModalCad3" tabindex="-1" role="dialog" aria-labelledby="ModalCad3" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalCad3">Verificar Pets</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <div class="center">
                        <h1 class="titulo">Lista de Pets</h1><br> 

                        <!-- Topo do Formulário-->
                        <div class="listar_pets">
                            <table class="table_servs table-bordere-dark"> <!--Tabela HTML-->
                                <tr> <!--Cria uma linha de uma tabela-->
                                    <td class="table-cel">ID</td><!--Cria uma coluna em uma linha-->
                                    <td class="table-cel">Nome</td>
                                    <td class="table-cel">ID da Espécie</td>
                                    <td class="table-cel">ID do Porte</td>
                                    <td class="table-cel">Criação</td>
                                    <td class="table-cel">Modificação</td>
                                    <td class="table-cel-btex">Edição</td>
                                    <td class="table-cel-bted">Exclusão</td>
                                </tr>
                            <?php
                                echo "<option value=''></option>";
                                while($row_pets_b = $result_pets_b->fetch(PDO::FETCH_ASSOC)){
                                    extract($row_pets_b);
                                    echo 
                                    "<tr>
                                        <td class='table_content'>$id </td>
                                        <td class='table_content'>$nome </td>
                                        <td class='table_content'>$especie_id </td>
                                        <td class='table_content'>$porte_id </td>
                                        <td class='table_content'>".date('d/m/y H:i:s', strtotime($created))."</td>
                                        <td class='table_content'>".date('d/m/y H:i:s', strtotime($modified))."</td>";
                                        if(!empty($modified)){
                                            // echo date('d/m/y H:i:s', strtotime($modified));
                                            echo "Sem modificação";
                                        };
                                        echo 
                                        "<td class='table_content'><a href=../editas/edita_user.php?id=$id>
                                        <button type = 'button' class= 'btn btn-sm btn-success'>Editar</button></a></td>";
                
                                        echo "<td class='table_content'><a href='../deletas/deleta_user.php?id=".$id."'data-confirm='tem certeza que deseha apagar?'><button type = 'button'  class= 'btn btn-sm btn-danger'>Excluir</button></a></td></tr>";
                                }
                            ?>
                            </table>
                        </div>
                        <!-- Fim do Formulário-->

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Modal 4-->
            <div class="modal fade bd-example-modal-xl" id="ModalCad4" tabindex="-1" role="dialog" aria-labelledby="ModalCad4" aria-hidden="true">
                
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content modal-xl">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalCad4">Verificar Serviços</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <div class="center">
                        <h1 class="titulo">Lista de Serviços</h1> 

                        <!-- Topo do Formulário-->
                        <table class="table_servs table-bordere-dark"> <!--Tabela HTML-->
                            <tr> <!--Cria uma linha de uma tabela-->
                                <td class="table-cel">ID</td><!--Cria uma coluna em uma linha-->
                                <td class="table-cel">Tipo de Serviço</td>
                                <td class="table-cel">Descrição</td>
                                <td class="table-cel">Imagem</td>
                                <td class="table-cel">Criação</td>
                                <td class="table-cel">Modificação</td>
                                <td class="table-cel-btex">Edição</td>
                                <td class="table-cel-bted">Exclusão</td>
                            </tr>
                        <?php
                            echo "<option value=''></option>";
                            while ($row_servicos = $result_servicos->fetch(PDO::FETCH_ASSOC)) {
                                extract($row_servicos);
                                echo 
                                "<tr>
                                    <td class='table_content'>$id </td>
                                    <td class='table_content'>$tipo_servico </td>
                                    <td class='table_content'>$descricao </td>
                                    <td class='table_content'><img width='250px' height='100' src='../css/imgs/$id/$imagem' alt='Imagem do serviço: $tipo_servico' class='conteudo_secundario_paragrafo_img'> </td>
                                    <td class='table_content'>".date('d/m/y H:i:s', strtotime($created))."</td>
                                    <td class='table_content'>".date('d/m/y H:i:s', strtotime($modified))."</td>";
                                    if(!empty($modified)){
                                        // echo date('d/m/y H:i:s', strtotime($modified));
                                        echo "Sem modificação";
                                    };
                                    echo 
                                    "<td class='table_content'><a href=../editas/edita_user.php?id=$id>
                                    <button type = 'button' class= 'btn btn-sm btn-success'>Editar</button></a></td>";
            
                                    echo "<td class='table_content'><a href='../deletas/deleta_user.php?id=".$id."'data-confirm='tem certeza que deseha apagar?'><button type = 'button'  class= 'btn btn-sm btn-danger'>Excluir</button></a></td></tr>";
                            }
                        ?>
                        </table>

                        <!-- Fim do Formulário-->

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal 5-->
            <div class="modal fade" id="ModalCad5" tabindex="-1" role="dialog" aria-labelledby="ModalCad5" aria-hidden="true"> <!--DIV 2-->
                <div class="modal-dialog modal-lg" role="document"><!--DIV 2-->
                    <div class="modal-content"> <!--DIV 3-->
                        <div class="modal-header"><!--DIV 5-->
                            <h5 class="modal-title" id="ModalCad5">Novo Usuário</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div><!--DIV 5-->
                        <div class="modal-body"><!--DIV 4-->
                            <div class="center"><!--DIV 6-->
                                <h1 class="titulo">Cadastro de Usuários</h1><br> 

                                <!-- Topo do Formulário-->
                                <form method="POST" action="../valida/valida_cad_adm.php" enctype="multipart/form-data">
                            
                                <div class="txt_field">
                                    <label>Nome:</label>
                                    <input type="text" name="nome" required>
                                    
                                </div>
                                <div class="txt_field">
                                    <label>E-mail:</label>
                                    <input type="email" name="email" required>
                                    
                                    <!--<br><br> -->
                                </div>

                                <div class="txt_field">
                                    <label>Senha:</label>
                                    <input type="password" name="senha" required>
                                    
                                </div>
                                <div class="txt_field">
                                    <label>Telefone:</label>
                                    <input type="tel" name="telefone" required>
                                                        
                                </div>
                                <div class="txt_field">
                                    <label>Complemento:</label>  
                                    <input type="text" name="complemento" required>
                                    
                                </div>
                                <label>CEP:</label>                
                                <select name="cep_id" id="cep_id"> 
                                    <?php
                                    echo "<option value=''>Selecione</option>";
                                    while ($row_cep = $result_cep->fetch(PDO::FETCH_ASSOC)) {
                                        extract($row_cep);
                                        echo "<option value = $id>$cep - $logradouro</option>";
                                    }
                                    ?>
                                </select><br>               
                                
                                <label>Nível de acesso:</label> 
                                <select name="nivel_acesso_id" id="nivel_acesso_id">                                  
                                    <?php                
                                    echo "<option value=''>Selecione</option>"; 
                                    while($row_nivel_acesso = $result_nivel_acesso->fetch(PDO::FETCH_ASSOC)){ 
                                        extract($row_nivel_acesso); 
                                        echo "<option value = $id>$nome</option>"; 
                                    }
                                ?>
                                
                                </select>
                                
                                <br><br><br>
                            
                                <input type="submit" name="tb_cadastro" value="Cadastrar">
                                <input type="reset" name="bt_reset" class="signup_link_apagar" value="Apagar">

                        </form>

                                <!-- Fim do Formulário-->
                            </div><!--DIV 6-->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div> <!--DIV 4-->
                    </div><!--DIV 3-->
                </div> <!--DIV 2-->
            </div> <!--DIV 2-->
            
            <!-- Modal 6-->
            <div class="modal fade" id="ModalCad6" tabindex="-1" role="dialog" aria-labelledby="ModalCad6" aria-hidden="true"> <!--DIV 2-->
                            <div class="modal-dialog modal-lg" role="document"><!--DIV 2-->
                                <div class="modal-content"> <!--DIV 3-->
                                    <div class="modal-header"><!--DIV 5-->
                                        <h5 class="modal-title" id="ModalCad6">Novo Pet</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div><!--DIV 5-->
                                    <div class="modal-body"><!--DIV 4-->
                                        <div class="center"><!--DIV 6-->
                                            <h1 class="titulo">Cadastro de Pet</h1><br> 

                                            <!-- Topo do Formulário-->
                                            <form method="POST" action="../valida/valida_pet_adm.php">

                                                <h2 class="subtitulo">Insira os dados do seu pet</h2>

                                                <div class="conteudo-form">
                                                    <div class="campo-form">
                                                        <label class="label-form" >Nome do pet:</label>
                                                        <input class="inserts-form" class="input-form" type="text" name="pet_nome" required>
                                                    </div>

                                                    <div class="campo-form">

                                                    <label class="label-form">Porte do pet</label>
                                                    <select name="porte_id" class="select-form" class="inserts-form">
                                                    <?php
                                                            echo "<option value=''>Selecione</option>";
                                                            while ($row_portes = $result_portes->fetch(PDO::FETCH_ASSOC)) {
                                                                extract($row_portes);
                                                                echo "<option value = $id>$id - $nome</option>";
                                                            }
                                                        ?>
                                                    </select>

                                                    </div>

                                                    <div class="campo-form">

                                                    <label class="label-form">Espécie do pet</label>
                                                    <select name="especie_id" class="select-form" class="inserts-form">
                                                    <?php
                                                            echo "<option value=''>Selecione</option>";
                                                            while ($row_especies = $result_especies->fetch(PDO::FETCH_ASSOC)) {
                                                                extract($row_especies);
                                                                echo "<option value = $id>$id - $nome</option>";
                                                            }
                                                        ?>
                                                    </select>

                                                    </div>
                                                </div>
                                                    
                                                    <!-- Formulário para cadastrar servico do pet-->
                                                    <input type="submit" name="bt_cadpet" value="Cadastrar">
                                                </form>
                                            <!-- Fim do Formulário-->
                                        </div><!--DIV 6-->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        </div>
                                    </div> <!--DIV 4-->
                                </div><!--DIV 3-->
                            </div> <!--DIV 2-->
                        </div> <!--DIV 2-->
               
            <!-- Modal 7-->
            <div class="modal fade" id="ModalCad7" tabindex="-1" role="dialog" aria-labelledby="ModalCad7" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalCad1">Novo Pedido</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <div class="center">
                        <h1 class="titulo">Cadastro de Pedido de Serviços</h1><br> 
                        <form method="POST" action="../valida/valida_prst_serv.php" enctype="multipart/form-data">

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
                            </select>
                            
                            
                            <input type="submit" name="bt-prst-serv" value="Cadastrar Produto">

                        </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </div>
                        </div>
                    </div>
                </div>
        </div>
        </div>
    </div>
                
<div>
    <script src="../js/jquery-3.3.1.slim.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/holder.min.js"></script>          <!--Chama o arquivo.Javascript-->
    <script src="custom.js"></script>
</div>
    </body>
</html>