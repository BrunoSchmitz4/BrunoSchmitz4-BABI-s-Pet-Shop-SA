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
                <div class="modal fade bd-example-modal-xl" id="ModalCad4" tabindex="-1" role="dialog" aria-labelledby="ModalCad4" aria-hidden="true">
                    
                    <div class="modal-dialog modal-xl" role="document">
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