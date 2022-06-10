<?php

session_start();

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

$query_users_a = "SELECT id, nome, email, senha, telefone, complemento, nivel_acesso_id, cep_id, created, modified FROM usuarios ORDER BY nome ASC";
$result_users_a = $conn->prepare($query_users_b); 
$result_users_a->execute();

$query_users_bt = "SELECT id, nome, email, senha, telefone, complemento, nivel_acesso_id, cep_id, created, modified FROM usuarios ORDER BY nome ASC";
$result_users_bt = $conn->prepare($query_users_bt); 
$result_users_bt->execute();


$result_pets_b = $conn->prepare($query_pets_b); 
$result_pets_b->execute();

$query_servicos = "SELECT id, tipo_servico, descricao, imagem FROM servicos ORDER BY id ASC";
$result_servicos = $conn->prepare($query_servicos);
$result_servicos->execute();


echo "<br>";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../css/bootstrap.css"> <!-- CSS para botão da tela modal-->

    <!--<link rel="stylesheet" href="../css/administrador.min.css">  CSS para cadastrro de serviço-->

    <!--<link rel='stylesheet' href='../css/style.css'/>  CSS para cadastro de usuário-->

    <!--<link rel='stylesheet' href='../css/listar_usuario.css'/>  CSS para listar usuários-->
    
    



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
                <a class="cabecalho_menu_item" href="../adm/cadastrar.php">Sair</a>
                <a class="cabecalho_menu_item" href="contato.php">Contato</a>
                <a class="cabecalho_menu_item" href="sobre.php">Sobre</a>
            </nav>
        </header>
        <main class="caixa-botoes">
            <button type="button" class="btn-btn-primary" data-toggle="modal" data-target="#ModalCad1">
                Cadastrar Serviço
            </button>
            <button type="button" class="btn-btn-primary" data-toggle="modal" data-target="#ModalCad2">
                Verificar Usuários
            </button>
            <button type="button" class="btn-btn-primary" data-toggle="modal" data-target="#ModalCad3">
                Verificar Pet
            </button>
            <button type="button" class="btn-btn-primary" data-toggle="modal" data-target="#ModalCad4">
                    Verificar Serviço
            </button>
        </main>

        <table class="table_users table-bordere-dark">
            <tr>
                <td class="table-cel">ID</td>
                <td class="table-cel">Nome</td>
                <td class="table-cel">E-mail</td>
                <td class="table-cel">Senha</td>
                <td class="table-cel">Telefone</td>
                <td class="table-cel">Complemento</td>
                <td class="table-cel">ID Nível de Acesso</td>
                <td class="table-cel">ID do CEP</td>
                <td class="table-cel">Criação</td>
                <td class="table-cel">Modificação</td>
                <td class="table-cel-btex">Edição</td>
                <td class="table-cel-bted">Exclusão</td>
            </tr>
            <?php
                while($row_user_a = $result_users_a->fetch(PDO::FETCH_ASSOC)){ // outro método extração
                    extract($row_user_a); // traz linha row relaciona, conteúdo array campo
                    echo "<tr><td class='table_content'>$id </td><td class='table_content'>$nome </td><td class='table_content'>$email </td><td class='table_content'>$senha </td><td class='table_content'>$telefone </td><td class='table_content'>$complemento </td><td class='table_content'>$nivel_acesso_id </td><td class='table_content'>$cep_id </td><td class='table_content'>".date('d/m/y H:i:s', strtotime($created))."</td>";
                    echo "<td class='table_content'><a class='table_linkbt'>Editar</a></td>";
                    while($row_user_bt = $result_users_bt->fetch(PDO::FETCH_ASSOC)){ // outro método extração
                        extract($row_user_bt);
                        echo "<td class='table_content'><a class='table_linkbt' href=''>Editar</a></td>";
                    }
                    echo "<td class='table_content'><a class='table_linkbt' href=''>Excluir</a></td>";
                    if(!empty($modified)){ 
                        echo date('d/m/y H:i:s', strtotime($modified))."</td>";
                    }"</tr>";
                }
            ?>
        </table>

            
        <div class="paineis">
            <!-- Modal -->
            <div class="modal fade" id="ModalCad1" tabindex="-1" role="dialog" aria-labelledby="ModalCad1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalCad1">Novo Serviço</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <div class="center">
                            <h1 class="titulo">Cadastro de Serviços</h1> 

                            <!-- Topo do Formulário-->
                            <form method="POST" action="../valida/valida_servico.php" enctype="multipart/form-data">
                                
                            <div class="form-field">
                                <label>Serviço:</label>
                                <input type="text" name="servico" required>   
                            </div>
                                
                            <div class="form-field">
                                <label>Sobre</label>
                                <textarea rows="5" cols='60' name="descricao" placeholder="Descreva o serviço..." required></textarea>
                            </div>
                                
                            <div class="form-field">      
                                <label>Imagem do Serviço</label>
                                <input type="file" name="imagem" accept="image/png,image/jpeg" required>                           
                            </div>   
                                
                                <input type="submit" name="bt-servico" value="Cadastrar Produto">

                            </form>

                            <!-- Fim do Formulário-->

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
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalCad2">Verificar Usuário</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <div class="center">
                            <h1 class="titulo">Lista de Usuários cadastrados</h1> 

                            <!-- Topo do Formulário-->
                            <div class="listar_usuario">
                                <?php
                                    while($row_user_b = $result_users_b->fetch(PDO::FETCH_ASSOC)){ // outro método extração
                                        extract($row_user_b); // traz linha row relaciona, conteúdo array campo
                                        
                                        echo "Id: $id <br>"; // campo como variável
                                        echo "Nome: $nome <br>";
                                        echo "E-mail: $email <br>";
                                        echo "Senha: $senha <br>";
                                        echo "Telefone: $telefone <br>";
                                        echo "Complemento: $complemento <br>";
                                        echo "Nível de acesso: $nivel_acesso_id <br>";
                                        echo "Cep: $cep_id <br>";
                                        echo "Cadastrado: ".date('d/m/y H:i:s', strtotime($created))."<br>"; 
                                        echo "Modificado: ";
                                        if(!empty($modified)){ 
                                            echo date('d/m/y H:i:s', strtotime($modified))."<br><br>";  
                                        }
                                        echo "<br><br><hr>"; 
                                    }
                                ?>
                            </div>
                            <!-- Fim do Formulário-->

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn-btn-secondary" data-dismiss="modal">Cancelar</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Modal 3-->
                <div class="modal fade" id="ModalCad3" tabindex="-1" role="dialog" aria-labelledby="ModalCa3" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalCad3">Verificar Pets</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <div class="center">
                            <h1 class="titulo">Lista de Pets</h1> 

                            <!-- Topo do Formulário-->
                            <div class="listar_pets">
                                <?php
                                    while($row_pets_b = $result_pets_b->fetch(PDO::FETCH_ASSOC)){ // outro método extração
                                        extract($row_pets_b); // traz linha row relaciona, conteúdo array campo
                                        
                                        echo "Id: $id <br>"; // campo como variável
                                        echo "Nome: $nome <br>";
                                        echo "ID da espécie: $especie_id <br>";
                                        echo "ID do porte: $porte_id <br>";
                                        echo "Cadastrado: ".date('d/m/y H:i:s', strtotime($created))."<br>"; 
                                        echo "Modificado: ";
                                        if(!empty($modified)){ 
                                            echo date('d/m/y H:i:s', strtotime($modified))."<br><br>";  
                                        }
                                        echo "<br><br><hr>"; 
                                    }
                                ?>
                            </div>
                            <!-- Fim do Formulário-->

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary3" data-dismiss="modal">Cancelar</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Modal 4-->
                <div class="modal fade" id="ModalCad4" tabindex="-1" role="dialog" aria-labelledby="ModalCad4" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
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
                            <?php
                                echo "<option value=''></option>";
                                while ($row_servicos = $result_servicos->fetch(PDO::FETCH_ASSOC)) {
                                    extract($row_servicos);
                                    echo "<ul>
                                    <li>ID: $id</li>
                                    <li>Tipo de serviço: $tipo_servico</li>
                                    <li>Descrição: $descricao</li>
                                    </ul>";
                                }
                            ?>

                            <!-- Fim do Formulário-->

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
    </body>
                

                
    <script src="../JS/jquery-3.3.1.slim.min.js"></script>
    <script src="../JS/popper.min.js"></script>
    <script src="../JS/bootstrap.min.js"></script>
    <script src="../JS/holder.min.js"></script>         
    </body>
</html>