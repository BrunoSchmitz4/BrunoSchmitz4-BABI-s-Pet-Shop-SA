<?php
session_start(); // Inicia a sessão do usuário, permitindo que ele possa se deslocar elas páginas sem que deslogue

include_once '../adm/config/conexao.php'; // faz a conexão com o banco de dados definido no conexão.php

if (isset($_SESSION['msg'])) { // Mostra mensagem caso: O usuário foi conectado ou não.
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

?>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/custom.css">
        <title>Recuperar Senha</title>
    </head>
    <body>
        <div class ="center">
            <h1>Recuperar Senha</h1>
            <form method ="POST" action="../valida/valida_rec_senha.php">
                <?php 
                    $email = "";
                    if(isset($dado['senha'])){
                        $email =  $dados['senha'];
                    }           
                ?>  
                <!--O metodo post não permite que as informações sejam expostas na url do site-->
                <!--A ação, NESTE CASO é feita para enviar os dados para a página valida_login.php, a fim de validar os dados e se condizem com os do banco-->
                <div class="txt_field">
                    <input type="text" name="email" value="<?php echo $email?>" required> <!--O required torna o campo obrigatório-->
                    <label>E-mail:</label> <!-- informar e-mail inserido no cadastro -->
                </div>                
                
                <br>
                <input type="submit" name="bt_rec_senha" value="Recuperar"> <!--Envia formulário-->
                <div class="signup_link">
                    <a href="../index.php">Voltar para o Login</a><!--Manda o usuário para a página de cadasto-->
                </div>
            </form>
        </div>
    </body>
</html>