<?php
session_start();

include_once './adm/config/conexao.php';

if (isset($_SESSION['msg'])) { // atualiza sessão, site para novo usuário
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
                <div class="txt_field">
                    <input type="text" name="nome" required>
                    <label>Usuário:</label>
                </div>                
                <div class="txt_field">
                    <input type="password" name="senha" required>
                    <label>Senha</label>
                </div>
                
                <div class="pass">Esqueceu a senha?</div>
                <br>
                <input type="submit" name="bt_login" value="Login">
                <div class="signup_link">
                    Não tem conta? <a href="adm/cadastrar.php">Cadastrar</a>
                </div>
            </form>
        </div>
    </body>
</html>