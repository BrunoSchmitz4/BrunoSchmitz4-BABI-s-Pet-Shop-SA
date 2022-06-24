<?php
session_start(); // Inicia a sessão do usuário, permitindo que ele possa se deslocar elas páginas sem que deslogue

include_once './adm/config/conexao.php'; // faz a conexão com o banco de dados definido no conexão.php

if (isset($_SESSION['msg'])) { // Mostra mensagem caso: O usuário foi conectado ou não.
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/custom.css">
        <title>Login</title>
    </head>
    <body>
        <div class ="center">
            <h1>Login</h1>
            <form method ="POST" action="valida/valida_login.php"> 
                <!--O metodo post não permite que as informações sejam expostas na url do site-->
                <!--A ação, NESTE CASO é feita para enviar os dados para a página valida_login.php, a fim de validar os dados e se condizem com os do banco-->
                <div class="txt_field">
                    <input type="text" name="nome" required> <!--O required torna o campo obrigatório-->
                    <label>Usuário:</label>
                </div>                
                <div class="txt_field">
                    <input type="password" name="senha" required>
                    <label>Senha</label>
                </div>
                
                <div class="pass">Esqueceu a senha?</div>
                <br>
                <input type="submit" name="bt_login" value="Login"> <!--Envia formulário-->
                <div class="signup_link">
                    Não tem conta? <a href="adm/cadastrar.php">Cadastrar</a><!--Manda o usuário para a página de cadasto-->
                </div>
            </form>
        </div>
    </body>
</html>