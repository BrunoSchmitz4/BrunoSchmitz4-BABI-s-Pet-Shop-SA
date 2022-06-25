<?php

session_start();

// echo "Crie seu formulário Cadastrar<br>";

include_once '../adm/config/conexao.php';
    
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../css/bootstrap.css">
</head>
    <body class="escopo">

      <div class="container-bt">
        <!-- Modais grandes -->
        <button type="button" class="btn-btn-primary" data-toggle="modal" data-target="#ModalCad1">
          Cadastrar Serviço
        </button>
        <button type="button" class="btn-btn-primary" data-toggle="modal" data-target="#ModalCad4">
                Verificar Serviço
        </button>
      </div>

      <div class="container-mdl">
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