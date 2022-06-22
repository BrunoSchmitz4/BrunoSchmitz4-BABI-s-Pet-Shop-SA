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

$query_ceps = "SELECT id, cep, logradouro FROM ceps ORDER BY cep ASC";
$result_cep = $conn->prepare($query_ceps);
$result_cep->execute();

$query_niveis_acessos = "SELECT id, nome FROM niveis_acessos ORDER BY nome ASC"; 
$result_nivel_acesso = $conn->prepare($query_niveis_acessos); 
$result_nivel_acesso->execute();
// var_dump($result_nivel_acesso);



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
                <a class="cabecalho_menu_item" href="../pags/cliente_loggout.php">Sair</a> <!--Links par navegação entre as páginas-->
                <a class="cabecalho_menu_item" href="../pags/clientelogged.php">Página do Cliente</a>
                <a class="cabecalho_menu_item" href="../pags/contato.php">Contato</a>
                <a class="cabecalho_menu_item" href="../pags/sobre.php">Sobre</a>
            </nav>
        </header>
        <main class="caixa-botoes">
            <br>
            <button type="button" class="btn-btn-primary" data-toggle="modal" data-target="#ModalCad1"> <!--Botão modal, que é do tipo botão (ah jura?), contém classe pré definida pelo boostrap, data-toggle do tipo modal (liga botão com atributo (tela) e data-targe, que ativa itens de id correspondentes-->
                Cadastrar Serviço
            </button>
            <button type="button" class="btn-btn-primary" data-toggle="modal" data-target="#ModalCad4">
                Verificar Serviço
            </button>
            <br>
            <button type="button" class="btn-btn-primary" data-toggle="modal" data-target="#ModalCad5">
                Cadastrar Usuários
            </button>
            <button type="button" class="btn-btn-primary" data-toggle="modal" data-target="#ModalCad2">
                Verificar Usuários
            </button>
            <br>
            <button type="button" class="btn-btn-primary" data-toggle="modal" data-target="#ModalCad3">
                Verificar Pet
            </button>
            
        </main>

        <table class="table_users table-bordere-dark"> <!--Tabela HTML-->
            <tr> <!--Cria uma linha de uma tabela-->
                <td class="table-cel">ID</td><!--Cria uma coluna em uma linha-->
                <td class="table-cel">Nome</td>
                <td class="table-cel">E-mail</td>
                <td class="table-cel">Senha</td>
                <td class="table-cel">Telefone</td>
                <td class="table-cel">Criação</td>
                <td class="table-cel">Modificação</td>
                <td class="table-cel-btex">Edição</td>
                <td class="table-cel-bted">Exclusão</td>
            </tr>
            <?php
                while($row_user_a = $result_users_a->fetch(PDO::FETCH_ASSOC)){ // outro método extração
                    extract($row_user_a); // traz linha row relaciona, conteúdo array campo
                    echo 
                    "<tr>
                        <td class='table_content'>$id </td>
                        <td class='table_content'>$nome </td>
                        <td class='table_content'>$email </td>
                        <td class='table_content'>$senha </td>
                        <td class='table_content'>$telefone </td>
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

             <!-- Novo Modal -->
            <!-- <div class="modal fade" id="ModalCad6" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalCad6">Confirmação</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <button type = 'button' class= 'btn btn-sm btn-danger'data-toggle='modal' data-target='#ModalCad6'>Excluir</button>
                        Tem certeza que deseja excluir?
                        
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                        </div>
                        </div>
                    </div>
             </div> -->
            
                    
        </table>

         <!-- fazer uma página separada para cada modal e depois só chamar, colocar o link deles aqui -->
            
        <div class="paineis"> <!--DIV 1-->

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
                            <h1 class="titulo">Cadastro de Serviços</h1><br> 
                            <!--Acima, ele cria a janela modal, e define como ela será ativa (neste caso, ela contém o id 1, e é definida como ModalCad1, ou seja, ela será aberta pelo botão com estas informações-->

                            <!-- Topo do Formulário-->
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

                            <!-- Fim do Formulário-->
                            <!-- Desde o topo ao fim do formulário é o conteúdo que irá aparecer no botão modal.
                            Lembrando que se houver TAG PHP ele provavelmente precisará de uma query-->

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div> <!--Fechanento do modal-->


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
                            <h1 class="titulo">Lista de Usuários Cadastrados</h1><br> 

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
                                    // extrai dados da tabela usuário
                                ?>
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
                            <h1 class="titulo">Lista de Pets</h1><br> 

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
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
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
                                    <li>Imagem do produto:<br><img width='250px' height='100' src='../css/imgs/$id/$imagem' alt='Imagem do serviço: $tipo_servico' class='conteudo_secundario_paragrafo_img'><br><hr></li>
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

                 <!-- Modal 5-->
                <div class="modal fade" id="ModalCad5" tabindex="-1" role="dialog" aria-labelledby="ModalCad5" aria-hidden="true"> <!--DIV 2-->
                    <div class="modal-dialog" role="document"><!--DIV 2-->
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
                        //                     <option value="1">Cliente</option>
                        //                     <option value="2">Colaborador</option>
                        //                     <option value="3">Administrador</option>;
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
        </div>
</body>
                

                
    <script src="../js/jquery-3.3.1.slim.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/holder.min.js"></script>          <!--Chama o arquivo.Javascript-->
    <script src="custom.js"></script>
    </body>
</html>