<?php

session_start();

// echo "Crie seu formulário Cadastrar<br>";

include_once '../adm/config/conexao.php';
    
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

$query_users_b = "SELECT id, nome, email, senha, telefone, complemento, nivel_acesso_id, cep_id, created, modified FROM usuarios";

$result_users_b = $conn->prepare($query_users_b); 
$result_users_b->execute();
echo "<br>";

?>

<!-- Antiga página do administrador-->


<html>
    <head> 
        <meta charset="UTF-8">
        <link rel='stylesheet' href='../css/administrador.css'>
        <title>Administrador</title>
    </head>
    <body>

        <div class="center">
            <h1 class="titulo">Cadastro de Serviços</h1> 
        
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
        </div>
        </div>
    </body>
</html>

