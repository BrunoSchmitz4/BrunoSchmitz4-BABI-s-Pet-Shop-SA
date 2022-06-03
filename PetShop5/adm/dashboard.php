<?php

session_start();

echo "<h2>Seu nome é: ".$_SESSION['nome']."</h2>"; 
echo "<h2>Sua senha é: ".$_SESSION['senha']."</h2>"; 
echo "<h2>Seu id é: ".$_SESSION['id']."</h2>"; 

?>


<!-- Dashboard com Página de Model page de modelo-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">

</head>
    <body>
        <div class="modal-test">
            
        </div>


         <!-- Nosso modal atual-->


         <!-- Botão para Cadastrar Serviços -->
        <div>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalCad">
                Cadastrar Serviço
            </button>
            
            <!-- Modal -->
            <div class="modal fade" id="ModalCad" tabindex="-1" role="dialog" aria-labelledby="ModalCad" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalCad">Novo Serviço</h5>
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
        </div>
    </body>

        <!-- Botão para Cadastrar Serviços -->
    <script src="../JS/jquery-3.3.1.slim.min.js"></script>
    <script src="../JS/popper.min.js"></script>
    <script src="../JS/bootstrap.min.js"></script>
    <script src="../JS/holder.min.js"></script>         
    </body>
</html>